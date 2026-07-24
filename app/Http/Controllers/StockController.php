<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductImei;
use App\Models\ProductVariant;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class StockController extends Controller
{
    



 public function index(Request $request)
{
    $search = $request->search;
    $type = $request->type;

    $stocks = Stock::with(['product', 'variant'])
        ->when($search, function ($query) use ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('note', 'like', "%{$search}%")
                  ->orWhereHas('product', function ($product) use ($search) {
                      $product->where('name', 'like', "%{$search}%");
                  });
            });
        })
        ->when($type, function ($query) use ($type) {
            $query->where('type', $type);
        })
        ->latest()
        ->paginate(15);

    $stocks->appends($request->all());

    return view('admin.pages.stocks.index', compact('stocks'));
}






    public function create()
    {
        $products = Product::orderBy('name', 'ASC')->get();

        return view('admin.pages.stocks.create', compact('products'));
    }

    public function getVariants($productId)
    {
        $variants = ProductVariant::where('product_id', $productId)->get();
        return response()->json($variants);
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'product_variant_id' => 'nullable|exists:product_variants,id',
            'quantity' => 'required|numeric|min:1',
            'note' => 'nullable|string|max:255',
        ]);

        DB::beginTransaction();
        try {
            $stock = new Stock();
            $stock->product_id = $request->product_id;
            $stock->product_variant_id = $request->product_variant_id;
            $stock->quantity = $request->quantity;
            $stock->type = 'in';
            $stock->note = $request->note;
            $stock->save();

            if ($request->has('use_imei') && $request->use_imei == 1) {
                $imeiArray = preg_split('/\r\n|\r|\n|,/', $request->imeis);
                $imeis = array_filter(array_map('trim', $imeiArray));

                if (count($imeis) != $request->quantity) {
                    throw new \Exception("Mismatch: Quantity is {$request->quantity} but " . count($imeis) . " IMEIs provided.");
                }

                foreach ($imeis as $imei) {
                    $exists = ProductImei::where('imei_number', $imei)->exists();
                    if ($exists) {
                        throw new \Exception("IMEI number $imei already exists in the system.");
                    }

                    ProductImei::create([
                        'product_id' => $request->product_id,
                        'product_variant_id' => $request->product_variant_id,
                        'imei_number' => $imei,
                        'status' => 'available'
                    ]);
                }
            }

            $product = Product::findOrFail($request->product_id);
            if ($request->use_imei == 1) {
                $product->requires_imei = true;
                $product->save();
            }
            $product->increment('available_qty', $request->quantity);

            DB::commit();
            return redirect()->route('stocks.index')->with('status', 'Inventory updated and stock added successfully!');

        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', $e->getMessage())->withInput();
        }
    }
}
