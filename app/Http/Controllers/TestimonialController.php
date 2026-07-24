<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function index(Request $request)
    {
        $query = Testimonial::query();

        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('name', 'like', "%{$searchTerm}%")
                    ->orWhere('description', 'like', "%{$searchTerm}%");
            });
        }

        if ($request->filled('is_active')) {
            $query->where('is_active', $request->is_active);
        }

        $testimonials = $query->latest()->paginate(25);
        return view('admin.pages.testimonials.index', compact('testimonials'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048'
        ]);

        $testimonial = new Testimonial();
        $testimonial->name = $request->name;
        $testimonial->description = $request->description ?? '';
        $testimonial->is_active = 1;

        // Image Upload Logic
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = 'testimonial_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/testimonials'), $filename);
            $testimonial->image = 'uploads/testimonials/' . $filename;
        }

        $testimonial->save();
        return back()->with('success', 'Testimonial added successfully!');
    }

    public function update(Request $request, $id)
    {
        $testimonial = Testimonial::findOrFail($id);
        $testimonial->name = $request->name;
        $testimonial->description = $request->description;
        $testimonial->is_active = $request->is_active;

        if ($request->hasFile('image')) {
            if ($testimonial->image && file_exists(public_path($testimonial->image))) {
                unlink(public_path($testimonial->image));
            }

            $file = $request->file('image');
            $filename = 'testimonial_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/testimonials'), $filename);
            $testimonial->image = 'uploads/testimonials/' . $filename;
        }

        $testimonial->save();
        return back()->with('success', 'Testimonial updated successfully!');
    }
}
