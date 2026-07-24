<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\PosOrder;
use App\Models\PosOrderItem;
use App\Models\Product;
use App\Models\ProductImei;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PosController extends Controller
{
    public function index()
    {
       $products = Product::with('variants')->paginate(15);
        $customers = Customer::all();
        return view('admin.pages.pos.index', compact('products', 'customers'));
    }

    public function getVariants($id)
    {
        $product = Product::with('variants')->findOrFail($id);

        // 1. Variable Product එකක් නම්
        if ($product->has_variants && $product->variants->isNotEmpty()) {
            return response()->json([
                'type' => 'variable',
                'variants' => $product->variants->map(function ($variant) use ($product) {
                    return [
                        'id' => $variant->id,
                        'color' => $variant->color,
                        'storage' => $variant->storage,
                        'price' => $variant->price,
                        'qty' => $product->requires_imei
                            ? ProductImei::where('product_id', $product->id)
                                ->where('product_variant_id', $variant->id)
                                ->where('status', 'available')
                                ->count()
                            : \App\Models\Stock::where('product_variant_id', $variant->id)
                                ->where('type', 'in')
                                ->sum('quantity')
                    ];
                }),
                'requires_imei' => (bool) $product->requires_imei
            ]);
        }

        return response()->json([
            'type' => 'simple',
            'product' => [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->base_price,
                'qty' => $product->available_qty
            ],
            'requires_imei' => (bool) $product->requires_imei
        ]);
    }

    public function getAvailableImeis($productId, $variantId = 0)
    {
        $query = ProductImei::where('product_id', $productId)
            ->where('status', 'available');

        if ($variantId > 0) {
            $query->where('product_variant_id', $variantId);
        }

        return $query->get();
    }

   









    public function checkout(Request $request)
{
    $cart = json_decode($request->cart, true);

    $customerId     = $request->customer_id;
    $paymentMethod  = $request->payment_method;
    $cashReceived   = (float) ($request->cash_received ?? 0);

    $billDiscType   = $request->bill_discount_type;
    $billDiscValue  = (float) ($request->bill_discount_value ?? 0);
    $billDiscAmount = (float) ($request->bill_discount_amount ?? 0);

    $grandTotal     = (float) ($request->grand_total ?? 0);
    $subtotal       = (float) ($request->subtotal ?? 0);

    if (!$cart || count($cart) === 0) {
        return response()->json(['success' => false, 'message' => 'Cart is empty'], 422);
    }

    DB::beginTransaction();

    try {

        $calculatedTotal = 0;

        // =========================
        // CREATE ORDER
        // =========================
        $posOrder = PosOrder::create([
            'customer_id'     => $customerId,
            'cashier_id'      => auth()->id(),
            'order_code'      => 'POS-' . now()->format('YmdHis') . rand(100, 999),
            'payment_method'  => $paymentMethod,
            'total_amount'    => $grandTotal,
            'paid_amount'     => ($paymentMethod === 'cash') ? $cashReceived : $grandTotal,
            'balance_amount'  => ($paymentMethod === 'cash') ? ($cashReceived - $grandTotal) : 0,

            // bill discount
            'bill_discount_type'   => $billDiscType,
            'bill_discount_value'  => $billDiscValue,
            'bill_discount_amount'=> $billDiscAmount,
            'subtotal'             => $subtotal,
        ]);

        // =========================
        // ORDER ITEMS
        // =========================
        foreach ($cart as $item) {

            $product = Product::find($item['product_id']);

            if (!$product) {
                throw new \Exception("Product not found");
            }

            if ($product->available_qty < $item['qty']) {
                throw new \Exception("Insufficient stock for: " . $product->name);
            }

            //  USE FRONTEND FINAL PRICE (discounted)
            $unitPrice = $item['discounted_unit_price'] ?? $item['price'];
            $lineTotal = $item['line_total'] ?? ($unitPrice * $item['qty']);

            $calculatedTotal += $lineTotal;

            $orderItem = PosOrderItem::create([
                'pos_order_id' => $posOrder->id,
                'product_id'   => $item['product_id'],
                'variant_id'   => $item['variant_id'] ?? null,

                'quantity'     => $item['qty'],
                'price'        => $unitPrice,

                // store discount info
                'discount_type'  => $item['discount_type'] ?? null,
                'discount_value' => $item['discount_value'] ?? 0,

                'line_total'   => $lineTotal,
            ]);

            // reduce stock
            $product->decrement('available_qty', $item['qty']);

            // reduce stock records in stocks table
            $query = \App\Models\Stock::where('product_id', $item['product_id']);
            if (!empty($item['variant_id'])) {
                $query->where('product_variant_id', $item['variant_id']);
            } else {
                $query->whereNull('product_variant_id');
            }

            $remainingToDecrement = $item['qty'];
            $stockRecords = $query->where('type', 'in')->where('quantity', '>', 0)->get();
            foreach ($stockRecords as $stockRec) {
                if ($remainingToDecrement <= 0) break;
                if ($stockRec->quantity >= $remainingToDecrement) {
                    $stockRec->decrement('quantity', $remainingToDecrement);
                    $remainingToDecrement = 0;
                } else {
                    $remainingToDecrement -= $stockRec->quantity;
                    $stockRec->update(['quantity' => 0]);
                }
            }

            \App\Models\Stock::create([
                'product_id' => $item['product_id'],
                'product_variant_id' => $item['variant_id'] ?? null,
                'quantity' => $item['qty'],
                'type' => 'out',
                'note' => 'POS Order #' . $posOrder->order_code . ' completed'
            ]);

            // =========================
            // IMEI HANDLING SAFE
            // =========================
            if (!empty($item['imeis'])) {
                if (count($item['imeis']) != $item['qty']) {
                    throw new \Exception("IMEI count mismatch for " . $product->name);
                }

                foreach ($item['imeis'] as $imei) {

                    $imeiRecord = ProductImei::where('id', $imei['id'])
                        ->where('status', 'available')
                        ->first();

                    if (!$imeiRecord) {
                        throw new \Exception("IMEI not available: " . ($imei['number'] ?? $imei['id']));
                    }

                    $imeiRecord->update([
                        'status' => 'sold',
                        'pos_order_item_id' => $orderItem->id
                    ]);
                }
            }
        }

        // =========================
        // FINAL SAFETY CHECK
        // =========================
        $finalTotal = $calculatedTotal - $billDiscAmount;

if (abs($finalTotal - $grandTotal) > 1) {
    throw new \Exception(
        "Total mismatch. Backend: {$finalTotal}, Frontend: {$grandTotal}"
    );
}

        // =========================
        // CASH VALIDATION
        // =========================
        if ($paymentMethod === 'cash' && $cashReceived < $grandTotal) {
            throw new \Exception("Insufficient cash received");
        }

        DB::commit();

        return response()->json([
            'success'  => true,
            'message'  => 'Order completed successfully!',
            'order_id' => $posOrder->id
        ]);

    } catch (\Exception $e) {
        DB::rollBack();

        return response()->json([
            'success' => false,
            'message' => $e->getMessage()
        ], 500);
    }
}




    public function printInvoice($orderId)
{
    $order = PosOrder::with([
        'items.product',
        'items.imeis',
        'items.variant',
        'customer'
    ])->findOrFail($orderId);
   
    return view('admin.pages.pos.invoice', compact('order'));
}
}
