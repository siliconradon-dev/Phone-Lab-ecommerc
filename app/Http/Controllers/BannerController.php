<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Banner;
use Illuminate\Support\Facades\File;

class BannerController extends Controller
{
    public function index()
    {
        $banners = Banner::orderBy('order', 'asc')->get();
        return view('admin.pages.banners.index', compact('banners'));
    }

    public function create()
    {
        return view('admin.pages.banners.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'order' => 'required|integer',
        ]);

        $banner = new Banner($request->only(['title', 'subtitle', 'link', 'offer_text', 'price_del', 'price_sale', 'order']));
        $banner->is_active = $request->has('is_active') ? true : false;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = 'banner_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/banners'), $filename);
            $banner->image = 'uploads/banners/' . $filename;
        }

        $banner->save();

        return redirect()->route('banners.index')->with('status', 'Banner added successfully.');
    }

    public function edit($id)
    {
        $banner = Banner::findOrFail($id);
        return view('admin.pages.banners.edit', compact('banner'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'order' => 'required|integer',
        ]);

        $banner = Banner::findOrFail($id);
        $banner->fill($request->only(['title', 'subtitle', 'link', 'offer_text', 'price_del', 'price_sale', 'order']));
        $banner->is_active = $request->has('is_active') ? true : false;

        if ($request->hasFile('image')) {
            // Delete old image
            if ($banner->image && File::exists(public_path($banner->image))) {
                File::delete(public_path($banner->image));
            }

            $file = $request->file('image');
            $filename = 'banner_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/banners'), $filename);
            $banner->image = 'uploads/banners/' . $filename;
        }

        $banner->save();

        return redirect()->route('banners.index')->with('status', 'Banner updated successfully.');
    }

    public function destroy($id)
    {
        $banner = Banner::findOrFail($id);
        if ($banner->image && File::exists(public_path($banner->image))) {
            File::delete(public_path($banner->image));
        }
        $banner->delete();

        return redirect()->route('banners.index')->with('status', 'Banner deleted successfully.');
    }
}
