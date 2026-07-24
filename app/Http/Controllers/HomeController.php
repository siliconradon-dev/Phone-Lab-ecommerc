<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Review;
use App\Models\Testimonial;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $banners = Banner::where('is_active', true)->orderBy('order', 'asc')->get();

        $newArrivals = Product::inStock()->where('is_new_arrival', true)->with(['variants', 'images', 'hotDeal'])->withAvg('reviews', 'rating')->orderBy('created_at', 'desc')->take(12)->get();
        if ($newArrivals->isEmpty()) {
            $newArrivals = Product::inStock()->with(['variants', 'images', 'hotDeal'])->withAvg('reviews', 'rating')->orderBy('created_at', 'desc')->take(12)->get();
        }

        $bestSellers = Product::inStock()->with(['variants', 'images', 'hotDeal'])
            ->withAvg('reviews', 'rating')
            ->withCount([
                'stocks as total_in' => function ($query) {
                    $query->where('type', 'in')->select(DB::raw('sum(quantity)'));
                }
            ])
            ->orderBy('total_in', 'desc')
            ->take(12)->get();

        $ourProducts = Product::inStock()->with(['variants', 'images', 'hotDeal'])->withAvg('reviews', 'rating')->orderBy('name', 'asc')->take(12)->get();

        $hotDeals = Product::inStock()
            ->whereHas('hotDeal', function ($query) {
                $query->where(function ($q) {
                    $q->whereNull('end_date')
                      ->orWhere('end_date', '>', now());
                });
            })
            ->with(['variants', 'images', 'hotDeal'])
            ->withAvg('reviews', 'rating')
            ->inRandomOrder()
            ->take(12)
            ->get();
        if ($hotDeals->isEmpty()) {
            $hotDeals = Product::inStock()->with(['variants', 'images', 'hotDeal'])->withAvg('reviews', 'rating')->inRandomOrder()->take(12)->get();
        }

        $carouselCategories = Category::with([
            'brands' => function ($query) {
                $query->take(4);
            }
        ])->take(6)->get();

        $homeBrands = Brand::orderBy('name', 'asc')->take(10)->get();


         $testimonials = Testimonial::where('is_active', 1)
    ->latest()
    ->paginate(6);

        return view('phone_lab.pages.index', compact('banners', 'newArrivals', 'bestSellers', 'ourProducts', 'hotDeals', 'carouselCategories', 'homeBrands', 'testimonials'));
    }




    public function goToAbout()
    {
        return view('phone_lab.pages.about');
    }

    public function goToContact()
    {
        return view('phone_lab.pages.contact');
    }












    public function goToShop(Request $request)
{
    $query = Product::inStock()->with(['variants', 'images', 'category'])
              ->withAvg('reviews', 'rating');

    // SEARCH (name + description)
    if ($request->filled('search')) {
        $searchTerm = trim($request->search);

        $query->where(function ($q) use ($searchTerm) {
            $q->where('name', 'LIKE', "%{$searchTerm}%")
              ->orWhere('description', 'LIKE', "%{$searchTerm}%");
        });
    }

    // CATEGORY FILTER
    if ($request->filled('category')) {
        $query->where('category_id', $request->category);
    }

    // BRAND FILTER
    if ($request->filled('brand')) {
        $query->where('brand_id', $request->brand);
    }

    // SORTING
    $sort = $request->get('sort', 'default');

    switch ($sort) {
        case 'price_low_high':
            $query->orderBy('base_price', 'asc');
            break;

        case 'price_high_low':
            $query->orderBy('base_price', 'desc');
            break;

        case 'name_asc':
            $query->orderBy('name', 'asc');
            break;

        default:
            $query->orderBy('created_at', 'desc');
            break;
    }

    // PAGINATION
    $products = $query->paginate(12)->withQueryString();

    // SIDEBAR DATA
    $sidebarCategories = Category::withCount('products')->get();
    $sidebarBrands = Brand::withCount('products')->get();

    $latestProducts = Product::inStock()
        ->orderBy('created_at', 'desc')
        ->take(5)
        ->get();

    return view('phone_lab.pages.shop', compact(
        'products',
        'sidebarCategories',
        'sidebarBrands',
        'latestProducts'
    ));
}









    public function productDetails($id, $slug)
    {
        $product = Product::inStock()
            ->with(['variants', 'images', 'category', 'brand'])
            ->findOrFail($id);

        if ($product->slug !== $slug) {
            return redirect()->route('product.details', [
                'id' => $product->id,
                'slug' => $product->slug
            ], 301);
        }

        $relatedProducts = Product::inStock()
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->take(4)
            ->get();
        
       $reviews = Review::where('product_id', $product->id)
    ->latest()
    ->paginate(5);

        return view('phone_lab.pages.product_details', compact('product', 'relatedProducts', 'reviews'));
    }

    public function orderTracking(Request $request)
    {
        $order = null;
        $searched = false;

        if ($request->filled('order_id') && $request->filled('billing_email')) {
            $order = \App\Models\Order::with(['items.product', 'items.variant', 'orderProcesses.stage'])
                ->where('order_code', trim($request->order_id))
                ->where('email', trim($request->billing_email))
                ->first();
            $searched = true;
        }

        return view('phone_lab.pages.other.order_tracking', compact('order', 'searched'));
    }
}
