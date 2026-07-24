<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\Setting;

class WebServiceController extends Controller
{
    public function discountIndex(Request $request)
    {
        $query = Product::query();

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('name', 'like', "%$search%")
                  ->orWhere('sku', 'like', "%$search%");
        }

        // Order by discount status and then updated_at
        $products = $query->with('variants')
                          ->orderBy('is_discount', 'desc')
                          ->orderBy('updated_at', 'desc')
                          ->paginate(25);

        return view('admin.pages.web-service.discount', compact('products'));
    }

    public function discountToggle(Request $request)
    {
        $request->validate([
            'product_id' => 'nullable|exists:products,id',
            'variant_id' => 'nullable|exists:product_variants,id',
            'is_discount' => 'required|boolean',
            'discount_price' => 'nullable|numeric|min:0'
        ]);

        if ($request->filled('variant_id')) {
            $variant = \App\Models\ProductVariant::findOrFail($request->variant_id);
            $variant->is_discount = $request->is_discount;
            $variant->discount_price = $request->is_discount ? ($request->discount_price ?? 0) : null;
            $variant->save();
            $status = 'Variant discount status updated.';
        } else {
            $product = Product::findOrFail($request->product_id);
            $product->is_discount = $request->is_discount;
            $product->discount_price = $request->is_discount ? ($request->discount_price ?? 0) : null;
            $product->save();
            $status = 'Product discount status updated.';
        }

        if ($request->ajax()) {
            return response()->json(['success' => true]);
        }
        return back()->with('status', $status);
    }

    public function newArrivalsIndex(Request $request)
    {
        $query = Product::query();

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('name', 'like', "%$search%")
                  ->orWhere('sku', 'like', "%$search%");
        }

        $products = $query->orderBy('is_new_arrival', 'desc')
                          ->orderBy('updated_at', 'desc')
                          ->paginate(25);

        return view('admin.pages.web-service.new-arrivals', compact('products'));
    }

    public function newArrivalsToggle(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'is_new_arrival' => 'required|boolean',
        ]);

        $product = Product::findOrFail($request->product_id);
        $product->is_new_arrival = $request->is_new_arrival;
        $product->save();

        if ($request->ajax()) {
            return response()->json(['success' => true]);
        }
        return back()->with('status', 'New Arrival status updated.');
    }

    public function hotDealsIndex(Request $request)
    {
        $query = Product::query();

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                  ->orWhere('sku', 'like', "%$search%");
            });
        }

        $products = $query->with('hotDeal')
                          ->leftJoin('hot_deals', 'products.id', '=', 'hot_deals.product_id')
                          ->select('products.*')
                          ->orderByRaw('CASE WHEN hot_deals.id IS NOT NULL THEN 1 ELSE 0 END DESC')
                          ->orderBy('products.updated_at', 'desc')
                          ->paginate(25);

        return view('admin.pages.web-service.hot-deals', compact('products'));
    }

    public function hotDealsToggle(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'is_hot_deal' => 'required|boolean',
            'hot_deal_discount_price' => 'required_if:is_hot_deal,1|nullable|numeric|min:0',
            'hot_deal_end_date' => 'nullable|date',
            'duration_days' => 'nullable|integer'
        ]);

        $product = Product::findOrFail($request->product_id);

        if ($request->is_hot_deal) {
            $endDate = null;
            if ($request->filled('duration_days')) {
                $endDate = now()->addDays((int)$request->duration_days);
            } elseif ($request->filled('hot_deal_end_date')) {
                $endDate = \Carbon\Carbon::parse($request->hot_deal_end_date);
            } else {
                $endDate = now()->addDay(); // Fallback to 1 day if not set
            }

            $product->hotDeal()->updateOrCreate(
                [],
                [
                    'discount_price' => $request->hot_deal_discount_price,
                    'end_date' => $endDate
                ]
            );
        } else {
            $product->hotDeal()->delete();
        }

        if ($request->ajax()) {
            return response()->json(['success' => true]);
        }
        return back()->with('status', 'Hot Deal status updated.');
    }

    public function updateNewArrivalsBanner(Request $request)
    {
        $request->validate([
            'banner_badge' => 'nullable|string|max:255',
            'banner_title' => 'required|string|max:255',
            'banner_desc' => 'required|string',
            'banner_link' => 'nullable|string|max:255',
            'banner_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        Setting::set('new_arrival_banner_badge', $request->banner_badge);
        Setting::set('new_arrival_banner_title', $request->banner_title);
        Setting::set('new_arrival_banner_desc', $request->banner_desc);
        Setting::set('new_arrival_banner_link', $request->banner_link ?? '/shop');

        if ($request->hasFile('banner_image')) {
            $oldImage = Setting::get('new_arrival_banner_image');
            if ($oldImage) {
                $oldImagePath = public_path($oldImage);
                if (file_exists($oldImagePath)) {
                    @unlink($oldImagePath);
                }
            }

            $file = $request->file('banner_image');
            $filename = 'new_arrival_banner_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/settings'), $filename);
            Setting::set('new_arrival_banner_image', 'uploads/settings/' . $filename);
        }

        return back()->with('status', 'New Arrival Banner updated successfully.');
    }
}
