<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BrandController extends Controller
{
    public function index(Request $request)
    {
        $query = Brand::query()->with('categories');

        if ($request->filled('search')) {
            $query->where('name', 'LIKE', '%' . $request->search . '%');
        }

        if ($request->filled('category_id')) {
            $query->whereHas('categories', function ($q) use ($request) {
                $q->where('categories.id', $request->category_id);
            });
        }

        $brands = $query->latest()->paginate(10)->appends($request->all());
        $all_categories = Category::all();

        return view('admin.pages.brands.index', compact('brands', 'all_categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:brands,name|max:255',
            'category_id' => 'required|array',
            'category_id.*' => 'exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'name.required' => 'Please enter a brand name.',
            'category_id.required' => 'Please select at least one category.',
        ]);

        // 2. Create Brand Object
        $brand = new Brand();
        $brand->name = $request->name;
        $brand->slug = Str::slug($request->name);

        // 3. Image Upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = Carbon::now()->format('YmdHis') . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/brands'), $filename);
            $brand->image = 'uploads/brands/' . $filename;
        }

        // 4. Save Brand
        $brand->save();

        $brand->categories()->sync($request->category_id);

        return redirect()->route('brands.index')->with('status', 'Brand added successfully!');
    }

    public function edit($id)
    {
        $brand = Brand::with('categories')->findOrFail($id);
        $assignedCategoryIds = $brand->categories->pluck('id');

        return response()->json([
            'brand' => $brand,
            'category_ids' => $assignedCategoryIds
        ]);
    }

    public function update(Request $request, $id)
    {
        $brand = Brand::findOrFail($id);

        $request->validate([
            'name' => 'required|max:255|unique:brands,name,' . $brand->id,
            'category_id' => 'required|array',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $brand->name = $request->name;
        $brand->slug = Str::slug($request->name);

        if ($request->hasFile('image')) {
            if ($brand->image) {
                $oldPath = public_path($brand->image);
                if (file_exists($oldPath)) {
                    unlink($oldPath);
                }
            }

            $image = $request->file('image');
            $filename = Carbon::now()->format('YmdHis') . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/brands'), $filename);
            $brand->image = 'uploads/brands/' . $filename;
        }
        $brand->save();

        $brand->categories()->sync($request->category_id);

        return redirect()->route('brands.index')->with('status', 'Brand updated successfully!');
    }
}
