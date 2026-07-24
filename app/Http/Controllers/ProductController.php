<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Stock;
use App\Models\Review;
use App\Models\ProductVariant;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with(['category', 'variants']);

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                    ->orWhere('sku', 'like', "%$search%");
            });
        }

        if ($request->has('category_id') && $request->category_id != '') {
            $query->where('category_id', $request->category_id);
        }

        $perPage = $request->get('per_page', 25);
        $products = $query->orderBy('created_at', 'desc')->paginate($perPage);

        $categories = Category::all();

        return view('admin.pages.products.index', compact('products', 'categories'));
    }

    public function create()
    {
        $categories = Category::orderBy('name', 'ASC')->get();
        $brands = Brand::orderBy('name', 'ASC')->get();

        return view('admin.pages.products.create', compact('categories', 'brands'));
    }

    public function getBrands($category_id)
    {
        $category = Category::find($category_id);

        if (!$category) {
            return response()->json([]);
        }

        $brands = $category->brands()->select('brands.id', 'brands.name')->get();

        return response()->json($brands);
    }



    public function store(Request $request)
    {
      
       
      
        $request->validate([
            'name' => 'required|max:255',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'description' => 'required',
        ]);

        

        DB::beginTransaction();

        try {
            $product = new Product();
            $product->name = $request->name;
            $product->slug = Str::slug($request->name) . '-' . time();
            $product->sku = $request->sku;
            $product->description = trim(strip_tags($request->description));
            $product->category_id = $request->category_id;
            $product->brand_id = $request->brand_id;
            $product->has_variants = $request->has('has_variants') ? true : false;
            $product->base_price = $request->has('has_variants') ? 0 : ($request->base_price ?? 0);
            $product->has_warranty = $request->has_warranty ?? 0;
            $product->warranty_period = $request->has_warranty ? $request->warranty_period : null;

            

            if ($request->hasFile('featured_image')) {
                $file = $request->file('featured_image');
                $filename = 'featured_' . time() . '.' . $file->getClientOriginalExtension();

                $file->move(public_path('uploads/products'), $filename);
                $product->featured_image = 'uploads/products/' . $filename;
            }
           
            $product->save();

           

            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $file) {
                    $filename = 'gallery_' . uniqid() . '.' . $file->getClientOriginalExtension();

                    $file->move(public_path('uploads/products/gallery'), $filename);

                    $product->images()->create([
                        'image_path' => 'uploads/products/gallery/' . $filename,
                        'is_main' => false
                    ]);
                }
            }

            
            if ($request->has('has_variants') && $request->has('variants')) {
                foreach ($request->variants as $index => $variantData) {
                    $variant = new ProductVariant();
                    $variant->product_id = $product->id;
                    $variant->color = $variantData['color'] ?? null;
                    $variant->storage = $variantData['storage'] ?? null;
                    $variant->ram = $variantData['ram'] ?? null;
                    $variant->price = $variantData['price'] ?? 0;

                    if ($request->hasFile("variants.$index.variant_image")) {
                        $vFile = $request->file("variants.$index.variant_image");
                        $vFilename = 'variant_' . uniqid() . '.' . $vFile->getClientOriginalExtension();

                        $vFile->move(public_path('uploads/products/variants'), $vFilename);
                        $variant->variant_image = 'uploads/products/variants/' . $vFilename;
                    }

                    $variant->save();
                }
               
            }

            DB::commit();
            
           
            return redirect()->route('products.index')->with('status', 'Product successfully published!');

        } catch (\Exception $e) {
    DB::rollback();
     

            return back()->with('error', $e->getMessage());
}
    }






   public function view($id, $slug)
{
    $product = Product::with(['variants', 'images', 'category', 'brand'])
        ->findOrFail($id);

    //  stock check (better than exists-only)
    $hasStock = Stock::where('product_id', $id)->sum('quantity') > 0;

    if (!$hasStock) {
        return redirect()->back()
            ->with('error', 'Please add stock for this product before viewing it.');
    }

    //  SEO slug safety redirect
    if ($product->slug !== $slug) {
        return redirect()->route('products.view', [
            'id' => $product->id,
            'slug' => $product->slug
        ], 301);
    }

    //  related products
    $relatedProducts = Product::where('category_id', $product->category_id)
        ->where('id', '!=', $product->id)
        ->take(4)
        ->get();

    //  reviews
    $reviews = Review::where('product_id', $product->id)
        ->latest()
        ->paginate(5);

    return view('phone_lab.pages.product_details', compact(
        'product',
        'relatedProducts',
        'reviews'
    ));
}






    public function edit($id)
    {
        $product = Product::with(['variants', 'images'])->findOrFail($id);
        $categories = Category::all();
        $brands = Brand::whereHas('categories', function ($q) use ($product) {
            $q->where('categories.id', $product->category_id);
        })->get();

        return view('admin.pages.products.edit', compact('product', 'categories', 'brands'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'name' => 'required|max:255',
            'category_id' => 'required',
            'brand_id' => 'required',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'images.*' => 'image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        DB::beginTransaction();
        try {
            $product->name = $request->name;
            $product->sku = $request->sku;
            $product->description = trim(strip_tags($request->description));
            $product->category_id = $request->category_id;
            $product->brand_id = $request->brand_id;
            $product->has_variants = $request->has('has_variants');
            $product->base_price = $request->has('has_variants') ? 0 : $request->base_price;
            $product->has_warranty = $request->has_warranty ?? 0;
            $product->warranty_period = ($request->has_warranty == 1) ? $request->warranty_period : null;

            if ($request->hasFile('featured_image')) {
                if ($product->featured_image) {
                    $oldFeaturedPath = public_path($product->featured_image);
                    if (file_exists($oldFeaturedPath)) {
                        unlink($oldFeaturedPath);
                    }
                }

                $file = $request->file('featured_image');
                $filename = 'featured_' . time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/products'), $filename);
                $product->featured_image = 'uploads/products/' . $filename;
            }
            $product->save();

            // 2. Handle Variations
            if ($request->has('has_variants')) {
                if ($request->has('variants') && is_array($request->variants)) {

                    $newVariantIds = [];

                    foreach ($request->variants as $index => $vData) {
                        $variantId = $vData['id'] ?? null;

                        $variant = ProductVariant::updateOrCreate(
                            ['id' => $variantId],
                            [
                                'product_id' => $product->id,
                                'color' => $vData['color'] ?? 'N/A',
                                'storage' => $vData['storage'] ?? 'N/A',
                                'ram' => $vData['ram'] ?? 'N/A',
                                'price' => $vData['price'] ?? 0,
                            ]
                        );

                        if ($request->hasFile("variants.$index.variant_image")) {
                            $vFile = $request->file("variants.$index.variant_image");
                            $vFilename = 'variant_' . uniqid() . '.' . $vFile->getClientOriginalExtension();
                            $vFile->move(public_path('uploads/products/variants'), $vFilename);
                            $variant->variant_image = 'uploads/products/variants/' . $vFilename;
                        } elseif (isset($vData['old_variant_image'])) {
                            $variant->variant_image = $vData['old_variant_image'];
                        }
                        $variant->save();

                        $newVariantIds[] = $variant->id;
                    }

                    $product->variants()->whereNotIn('id', $newVariantIds)->delete();
                }
            } else {
                $product->variants()->delete();
            }

            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $file) {
                    $filename = 'gallery_' . uniqid() . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('uploads/products/gallery'), $filename);

                    $product->images()->create([
                        'image_path' => 'uploads/products/gallery/' . $filename,
                        'is_main' => false
                    ]);
                }
            }

            DB::commit();
            return redirect()->route('products.index')->with('status', 'Product updated successfully!');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', $e->getMessage());
        }
    }

    //search function
    public function search(Request $request)
    {
        $query = $request->get('query');

        $products = Product::where('name', 'LIKE', "%{$query}%")
            ->limit(5)
            ->get();

        return response()->json($products);
    }
}
