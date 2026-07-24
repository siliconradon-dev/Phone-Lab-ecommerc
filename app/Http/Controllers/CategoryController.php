<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index(Request $request)
{
    $query = Category::query();

    if ($request->filled('search')) {
        $query->where('name', 'LIKE', '%' . $request->search . '%');
    }

    $categories = $query->latest()->paginate(10);

    //  If AJAX request → return only table partial
    if ($request->ajax()) {
    return view('admin.components.table', compact('categories'))->render();
}
    // normal page load
    return view('admin.pages.categories.index', compact('categories'));
}




    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories,name|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ], [
            'name.required' => 'The category name field is required.',
            'name.unique' => 'This category name already exists.',
            'image.image' => 'The file must be an image.',
            'image.mimes' => 'Supported formats are: jpeg, png, jpg, gif, webp.',
        ]);

        $category = new Category();
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);

        if ($request->hasFile('image')) {
            $image = $request->file('image');

            $file_extension = $image->getClientOriginalExtension();
            $file_name = Carbon::now()->format('YmdHis') . '.' . $file_extension;

            $image->move(public_path('uploads/categories'), $file_name);

            $category->image = 'uploads/categories/' . $file_name;
        }

        $category->save();

        return redirect()->route('categories.index')->with('status', 'Category added successfully!');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return response()->json($category);
    }

    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $request->validate([
            'name' => 'required|max:255|unique:categories,name,' . $category->id,
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ], [
            'name.required' => 'The category name field is required.',
            'name.unique' => 'This category name already exists.',
            'image.image' => 'The file must be an image.',
            'image.mimes' => 'Supported formats are: jpeg, png, jpg, gif, webp.',
        ]);

        $category->name = $request->name;
        $category->slug = Str::slug($request->name);

        if ($request->hasFile('image')) {
            if ($category->image) {
                $oldImagePath = public_path($category->image);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            $image = $request->file('image');
            $file_extension = $image->getClientOriginalExtension();
            $file_name = Carbon::now()->format('YmdHis') . '.' . $file_extension;

            $image->move(public_path('uploads/categories'), $file_name);

            $category->image = 'uploads/categories/' . $file_name;
        }

        $category->save();

        return redirect()->route('categories.index')->with('status', 'Category updated successfully!');
    }
}
