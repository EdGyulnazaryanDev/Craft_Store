@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center mb-4">Edit Product</h1>
        <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group mb-3">
                <label for="name">Product Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ $product->name }}" required>
            </div>
            <div class="form-group mb-3">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control" required>{{ $product->description }}</textarea>
            </div>
            <div class="form-group mb-3">
                <label for="price">Price</label>
                <input type="number" name="price" id="price" class="form-control" value="{{ $product->price }}" step="0.01" required>
            </div>
            <div class="form-group mb-3">
                <label for="image">Product Image</label>
                <div class="mb-3">
                    @if ($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="img-thumbnail" width="150">
                    @else
                        <div class="text-muted">No image available</div>
                    @endif
                </div>
                <input type="file" name="image" id="image" class="form-control">
                <small class="form-text text-muted">Leave blank to keep the current image.</small>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Update Product</button>
            <a href="{{ route('products.index') }}" class="btn btn-secondary mt-3">Cancel</a>
        </form>
    </div>
@endsection
