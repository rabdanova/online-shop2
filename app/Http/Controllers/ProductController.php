<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddReviewRequest;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class ProductController
{
    public function getCatalog()
    {
        $products = Product::all();

        return view('catalog', compact('products'));
    }

    public function getProductPage(int $id)
    {
        $product = Product::with('reviews')->findOrFail($id);
        $reviews = $product->reviews;

        $averageRating = $reviews->avg('rating') ?? 0;
        $averageRating = round($averageRating, 2);

        return view('productPage', compact('product', 'averageRating', 'reviews'));
    }

    public function addReview(AddReviewRequest $request)
    {
        $userId = Auth::id();

        Review::query()->create([
            'product_id' => $request->input('product_id'),
            'user_id' => $userId,
            'name' => $request->input('name'),
            'rating' => $request->input('rating'),
            'comment' => $request->input('comment'),
        ]);

        return redirect()->route('productPage', ['id' => $request->input('product_id')]);

    }
}
