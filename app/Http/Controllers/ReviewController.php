<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Product;
use Illuminate\Http\Request;

class ReviewController extends Controller
{


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $request->validate([
            'name' => 'required|string|max:255',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string',
            'images.*' => 'image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $images = [];

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('reviews', 'public');
                $images[] = $path;
            }
        }

        Review::create([
            'name' => $request->name,
            'rating' => $request->rating,
            'comment' => $request->comment,
            'images' => $images,
            'product_id' => $request->product_id ?? null,
        ]);

        return back()->with('success', 'Review submitted successfully!');
    }








    /**
     * Display the specified resource.
     */
    public function show($id)
{
    $product = Product::findOrFail($id);

    $reviews = Review::where('product_id', $id)
        ->latest()
        ->paginate(5);

    return view('product.show', compact('product', 'reviews'));
}






    
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Review $review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Review $review)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Review $review)
    {
        //
    }
}
