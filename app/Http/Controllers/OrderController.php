<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderProcess;
use App\Models\Product;
use App\Models\ProductImei;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::query()->latest();

        // Search by Order Code or Full Name
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('order_code', 'like', '%' . $request->search . '%')
                    ->orWhere('full_name', 'like', '%' . $request->search . '%');
            });
        }

        // Filter by Status
        if ($request->filled('status')) {
            $query->where('order_status', $request->status);
        }

        // Filter by Payment Method
        if ($request->filled('payment_method')) {
            $query->where('payment_method', $request->payment_method);
        }

        $orders = $query->latest()->paginate(15)->appends($request->query());

        return view('admin.pages.orders.index', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::with(['items.product', 'items.variant'])->findOrFail($id);

        return view('admin.pages.orders.show', compact('order'));
    }

    public function updateTracking(Request $request, $id)
    {
        $request->validate([
            'processes' => 'required|array',
            'processes.*.status' => 'required|in:pending,processing,completed',
            'processes.*.tracking_number' => 'nullable|string|max:255',
        ]);

        $order = Order::findOrFail($id);

        if ($request->has('processes')) {
            // Check payment validation for online payment methods
            if ($order->payment_method !== 'cash' && $order->payment_status !== 'paid') {
                foreach ($request->processes as $processId => $data) {
                    if (in_array($data['status'], ['processing', 'completed'])) {
                        return back()->with('error', 'Cannot update tracking status. Online payments (Card/Koko) must be Paid before updating tracking.');
                    }
                }
            }

            try {
                DB::transaction(function () use ($request, $id, $order) {
                    foreach ($request->processes as $processId => $data) {
                        $process = OrderProcess::where('id', $processId)
                            ->where('order_id', $id)
                            ->first();

                        if ($process) {
                            // Prevent manual completion of Stage 3 (Order Complete) if order is not completed
                            if ($process->order_stage_id == 3 && $data['status'] === 'completed' && $order->order_status !== 'completed') {
                                throw new \Exception("Stage 'Order Complete' can only be completed by using the 'Confirm & complete order' button above.");
                            }

                            $updateData = [
                                'status' => $data['status'],
                                'tracking_number' => $data['tracking_number'] ?? $process->tracking_number,
                            ];

                            if ($data['status'] === 'completed' && $process->status !== 'completed') {
                                $updateData['end_date'] = now();
                            }

                            $process->update($updateData);
                        }
                    }
                });

                return back()->with('success', 'All tracking details updated successfully!');
            } catch (\Exception $e) {
                return back()->with('error', $e->getMessage());
            }
        }

        return back()->with('error', 'No tracking data provided.');
    }

    public function completeOrder(Request $request, $id)
    {
        $order = Order::with(['items.product', 'items.variant'])->findOrFail($id);

        if ($order->order_status === 'completed') {
            return back()->with('error', 'This order is already completed.');
        }

        try {
            DB::transaction(function () use ($order, $request) {
                foreach ($order->items as $item) {

                    // 1. IMEI Validation & Status Update
                    $availableImeisCount = ProductImei::where('product_id', $item->product_id)
                        ->where('status', 'available')
                        ->count();

                    $selectedImeiIds = $request->input("imei_ids_{$item->id}", []);

                    if ($availableImeisCount > 0) {
                        if (empty($selectedImeiIds)) {
                            throw new \Exception("Please select IMEI(s) for {$item->product->name}.");
                        }

                        if (count($selectedImeiIds) != $item->quantity) {
                            throw new \Exception("Please select exactly {$item->quantity} IMEI(s) for {$item->product->name}.");
                        }

                        foreach ($selectedImeiIds as $imeiId) {
                            $imei = ProductImei::where('id', $imeiId)
                                ->where('product_id', $item->product_id)
                                ->where('status', 'available')
                                ->first();

                            if ($imei) {
                                $imei->update(['status' => 'sold']);
                            } else {
                                throw new \Exception("One of the selected IMEIs for {$item->product->name} is invalid or already sold.");
                            }
                        }
                    }

                    // 2. Stock Management
                    $query = Stock::where('product_id', $item->product_id);
                    if ($item->variant_id) {
                        $query->where('product_variant_id', $item->variant_id);
                    } else {
                        $query->whereNull('product_variant_id');
                    }

                    $totalAvailableStock = (int) (clone $query)->where('type', 'in')->sum('quantity');

                    if ($totalAvailableStock >= $item->quantity) {
                        $remainingToDecrement = $item->quantity;
                        $stockRecords = (clone $query)->where('type', 'in')->where('quantity', '>', 0)->get();

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

                        Stock::create([
                            'product_id' => $item->product_id,
                            'product_variant_id' => $item->variant_id,
                            'quantity' => $item->quantity,
                            'type' => 'out',
                            'note' => 'Order #' . $order->order_code . ' completed'
                        ]);

                        $product = Product::findOrFail($item->product_id);
                        $product->decrement('available_qty', $item->quantity);
                    } else {
                        throw new \Exception("Insufficient stock for {$item->product->name}.");
                    }
                }

                // 3. Finalize Order
                $order->update([
                    'order_status' => 'completed'
                ]);

                // Update all associated order processes to completed
                OrderProcess::where('order_id', $order->id)->update([
                    'status' => 'completed',
                    'end_date' => now()
                ]);
            });

            return back()->with('success', 'Order completed successfully!');

        } catch (\Exception $e) {
            // Redirect back with the error message to be caught by SweetAlert
            return back()->with('error', $e->getMessage())->withInput();
        }
    }

    public function updatePaymentStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        if ($order->payment_method === 'cash') {
            $order->update(['payment_status' => 'paid']);
            return back()->with('success', 'Payment status updated to Paid.');
        }

        return back()->with('error', 'Only cash payments can be manually updated.');
    }
}
