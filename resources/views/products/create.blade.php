@extends('layouts.app')

@section('content')
    <section class="card form-card">
        <h2 class="section-title">Create Product</h2>

        <form class="form-grid" method="POST" action="{{ route('products.store') }}">
            @csrf

            <div class="form-field">
                <label for="Name">Product Name</label>
                <input id="Name" name="Name" type="text" value="{{ old('Name') }}" required>
            </div>

            <div class="form-field">
                <label for="Description">Description</label>
                <textarea id="Description" name="Description" required>{{ old('Description') }}</textarea>
            </div>

            <div class="form-field">
                <label for="Price">Price</label>
                <input id="Price" name="Price" type="number" min="0" step="0.01" value="{{ old('Price') }}" required>
            </div>

            <div class="form-field">
                <label for="Points">Points</label>
                <input id="Points" name="Points" type="number" min="0" step="1" value="{{ old('Points') }}" required>
            </div>

            <div class="action-row">
                <button class="btn" type="submit">Create Product</button>
                <a class="btn btn-secondary" href="{{ route('products.index') }}">Cancel</a>
            </div>
        </form>
    </section>
@endsection
