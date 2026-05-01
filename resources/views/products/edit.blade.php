@extends('layouts.app')

@section('content')
    <section class="card form-card">
        <h2 class="section-title">Edit Product</h2>

        <form class="form-grid" method="POST" action="{{ route('products.update', $product->ProductID) }}">
            @csrf
            @method('PUT')

            <div class="form-field">
                <label for="Name">Product Name</label>
                <input id="Name" name="Name" type="text" value="{{ old('Name', $product->Name) }}" required>
            </div>

            <div class="form-field">
                <label for="Description">Description</label>
                <textarea id="Description" name="Description" required>{{ old('Description', $product->Description) }}</textarea>
            </div>

            <div class="form-field">
                <label for="Price">Price</label>
                <input id="Price" name="Price" type="number" min="0" step="0.01" value="{{ old('Price', $product->Price) }}" required>
            </div>

            <div class="form-field">
                <label for="Points">Points</label>
                <input id="Points" name="Points" type="number" min="0" step="1" value="{{ old('Points', $product->Points) }}" required>
            </div>

            <div class="action-row">
                <button class="btn" type="submit">Save Changes</button>
                <a class="btn btn-secondary" href="{{ route('products.show', $product->ProductID) }}">Cancel</a>
            </div>
        </form>
    </section>
@endsection
