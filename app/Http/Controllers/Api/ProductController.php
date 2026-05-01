<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
    // Ashutosh: paginated product API responses backed by Eloquent relationships.
    public function index(): JsonResponse
    {
        $products = Product::withCount('reviews')
            ->orderBy('Name')
            ->paginate(10);

        return response()->json($products);
    }

    public function show(int $id): JsonResponse
    {
        $product = Product::with(['reviews.user', 'orders'])
            ->findOrFail($id);

        return response()->json($product);
    }
}
