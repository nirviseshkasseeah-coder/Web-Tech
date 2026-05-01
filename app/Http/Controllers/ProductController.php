<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    // Ashutosh: product CRUD and pagination for the Laravel web interface.
    public function index(): View
    {
        // Eager load reviews so the listing can show counts without N+1 queries.
        $products = Product::with('reviews')
            ->orderBy('Name')
            ->paginate(12);

        return view('products.index', compact('products'));
    }

    public function create(): View
    {
        return view('products.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'Name' => ['required', 'string', 'max:255'],
            'Description' => ['required', 'string'],
            'Price' => ['required', 'numeric', 'min:0'],
            'Points' => ['required', 'integer', 'min:0'],
        ]);

        $product = Product::create($validated);

        return redirect()
            ->route('products.show', $product->ProductID)
            ->with('status', 'Product created successfully.');
    }

    public function show(int $id): View
    {
        // Load the product, its reviews, and the review authors in one query chain.
        $product = Product::with(['reviews.user', 'orders'])
            ->findOrFail($id);

        return view('products.show', compact('product'));
    }

    public function edit(int $id): View
    {
        $product = Product::findOrFail($id);

        return view('products.edit', compact('product'));
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $product = Product::findOrFail($id);

        $validated = $request->validate([
            'Name' => ['required', 'string', 'max:255'],
            'Description' => ['required', 'string'],
            'Price' => ['required', 'numeric', 'min:0'],
            'Points' => ['required', 'integer', 'min:0'],
        ]);

        $product->update($validated);

        return redirect()
            ->route('products.show', $product->ProductID)
            ->with('status', 'Product updated successfully.');
    }

    public function destroy(int $id): RedirectResponse
    {
        $product = Product::findOrFail($id);
        $deletedName = $product->Name;
        $product->delete();

        return redirect()
            ->route('products.index')
            ->with('status', "Product {$deletedName} deleted successfully.");
    }
}
//This controller provides full web CRUD operations for products: paginated listing (12 per page) with reviews eager-loaded,
//create form, validated store, detailed view with reviews/orders/commenters, edit form, validated update, and delete — all returning redirects with status messages.
