@extends('layouts.app')

@section('content')
    <section>
        <div class="toolbar">
            <h2 class="section-title">Our Products</h2>
            <a class="btn" href="{{ route('products.create') }}">Add Product</a>
        </div>

        <div class="grid">
            @foreach ($products as $product)
                <article class="card">
                    <div class="meta">Product #{{ $product->ProductID }}</div>
                    <h3>{{ $product->Name }}</h3>
                    <p>{{ \Illuminate\Support\Str::limit($product->Description, 110) }}</p>
                    <div class="price">Rs {{ number_format((float) $product->Price, 2) }}</div>
                    <div class="meta">Points: {{ $product->Points }}</div>
                    <div class="meta">Reviews: {{ $product->reviews->count() }}</div>

                    <div class="action-row">
                        <a class="btn" href="{{ route('products.show', $product->ProductID) }}">
                            View Details
                        </a>
                        <a class="btn btn-secondary" href="{{ route('products.edit', $product->ProductID) }}">
                            Edit
                        </a>
                    </div>
                </article>
            @endforeach
        </div>

        <div class="pagination-wrap">
            <nav class="pagination-bar" aria-label="Product pages">
                <a
                    class="pagination-link {{ $products->onFirstPage() ? 'is-disabled' : '' }}"
                    href="{{ $products->previousPageUrl() ?: '#' }}"
                >
                    Prev
                </a>

                <span class="pagination-status">
                    Page {{ $products->currentPage() }} of {{ $products->lastPage() }}
                </span>

                <a
                    class="pagination-link {{ $products->hasMorePages() ? '' : 'is-disabled' }}"
                    href="{{ $products->nextPageUrl() ?: '#' }}"
                >
                    Next
                </a>
            </nav>
        </div>
    </section>
@endsection
