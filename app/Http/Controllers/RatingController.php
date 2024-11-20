<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rating;
use App\Models\Product;
class RatingController extends Controller
{
    public function store(Request $request, $product_id)
    {
        $request->validate([
            'rating' => 'required|integer|between:1,5',
            'review' => 'nullable|string|max:255',
        ]);

        $rating = new Rating();
        $rating->user_id = auth()->id();
        $rating->product_id = $product_id;
        $rating->rating = $request->rating;
        $rating->review = $request->review;
        $rating->save();

        return redirect()->route('show_product', $product_id)->with('success', 'Thank you for your review!');
    }

    public function showProduct($product_id)
    {
        $product = Product::findOrFail($product_id);
        $ratings = Rating::where('product_id', $product_id)->with('user')->get();

        return view('product.show', compact('product', 'ratings'));
    }
}
