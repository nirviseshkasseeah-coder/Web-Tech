<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    // Ryan: authenticated review submission endpoint for the REST API.
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'ProductID' => ['required', 'integer', 'exists:products,ProductID'],
            'Rating' => ['required', 'integer', 'min:1', 'max:5'],
            'Comment' => ['required', 'string', 'min:5', 'max:500'],
        ]);

        $product = Product::findOrFail($validated['ProductID']);

        $review = Review::create([
            'UserID' => $request->user()->UserID,
            'ProductID' => $product->ProductID,
            'Rating' => $validated['Rating'],
            'Comment' => $validated['Comment'],
        ]);

        $review->load(['product', 'user']);

        return response()->json([
            'message' => 'Review submitted successfully.',
            'review' => $review,
        ], 201);
    }
}
//This controller handles authenticated review submissions: it validates the request (ProductID exists, rating 1-5, comment 5-500 chars),
//Creates a review linked to the authenticated user and product, loads the related product/user data, and returns the created review with a 201 status.
