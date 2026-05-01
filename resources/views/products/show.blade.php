@extends('layouts.app')

@section('content')
    <section class="detail-layout">
        <article class="card">
            <div class="meta">Product #{{ $product->ProductID }}</div>
            <h2>{{ $product->Name }}</h2>
            <p>{{ $product->Description }}</p>

            <div class="price">Rs {{ number_format((float) $product->Price, 2) }}</div>
            <div class="meta">Points: {{ $product->Points }}</div>

            <div class="action-row">
                <a class="btn" href="{{ route('products.index') }}">Back to Products</a>
                <a class="btn btn-secondary" href="{{ route('products.edit', $product->ProductID) }}">Edit Product</a>
                <form class="inline-form" method="POST" action="{{ route('products.destroy', $product->ProductID) }}">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" type="submit" onclick="return confirm('Delete this product?')">
                        Delete
                    </button>
                </form>
            </div>
        </article>

        <aside class="card">
            <h3>Order Relationship Demo</h3>
            <p class="meta">
                This panel helps you demonstrate the many-to-many relationship from products to orders.
            </p>

            @forelse ($product->orders as $order)
                <div class="review">
                    <strong>Order #{{ $order->OrderID }}</strong>
                    <div class="meta">
                        Quantity:
                        {{ $order->pivot->Quantity ?? 'N/A' }}
                    </div>
                    <div class="meta">
                        Line Total:
                        {{ isset($order->pivot->TotalPrice) ? 'Rs ' . number_format((float) $order->pivot->TotalPrice, 2) : 'N/A' }}
                    </div>
                </div>
            @empty
                <p class="meta">No linked orders found for this product.</p>
            @endforelse
        </aside>
    </section>

    <section style="margin-top: 24px;">
        <h3 class="section-title">Customer Reviews</h3>

        <div class="stack">
            @forelse ($product->reviews as $review)
                <article class="review">
                    <strong>{{ $review->user->Username ?? 'Unknown user' }}</strong>
                    <div class="stars">Rating: {{ (int) $review->Rating }}/5</div>
                    <p>{{ $review->Comment }}</p>
                    <div class="meta">
                        {{ optional($review->CreatedAt)->format('d M Y, H:i') ?? 'Date unavailable' }}
                    </div>
                </article>
            @empty
                <article class="review">
                    <p class="meta">No reviews yet for this product.</p>
                </article>
            @endforelse
        </div>
    </section>
@endsection
