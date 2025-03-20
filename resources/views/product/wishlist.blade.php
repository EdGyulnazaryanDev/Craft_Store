@extends('layouts.app')
@section('content')
    <style>
        .wishlist-btn {
            background: none;
            border: none;
            color: inherit;
            font-size: 1.5rem;
            cursor: pointer;
        }

        .wishlist-btn:hover {
            color: #f00;  /* Optional hover effect */
        }

    </style>
    <div class="container" >
        <h1 class="text-center my-4">Wishlist Products</h1>
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4" id="wishlist-container">
            @foreach ($products as $product)
                <div class="col">
                    <div class="card h-100 shadow-sm" id="{{ $product->id }}">
                        <div class="position-relative">
                            @if ($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="card-img-top img-fluid" style="height: 200px; object-fit: cover;">
                            @else
                                <div class="text-center py-5 bg-light">No Image</div>
                            @endif
                            <button class="wishlist-btn position-absolute top-0 end-0 m-1 btn" data-product-id="{{ $product->id }}" data-product-slug="{{ $product->slug }}">
                                <i class="wishlist-icon fa {{ array_key_exists($product->id, auth()->user()->wishlist->pluck('user_id', 'product_id')->toArray()) ? 'clicked text-danger fa-heart' : 'text-secondary fa-heart-o' }}"></i>
                            </button>
                        </div>
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text flex-grow-1">{{ $product->description }}</p>
                            <p class="card-text"><strong>${{ $product->price }}</strong></p>
                            <div class="d-grid gap-2">
                                @can('product-list')
                                    <a href="{{ route('products.show', $product->id) }}" class="btn btn-info">View</a>
                                @endcan
                                @can('product-edit')
                                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning">Edit</a>
                                @endcan
                                @can('product-delete')
                                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="d-grid">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                @endcan
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <script>
        $(document).ready(function() {
            function updateWishlistCount() {
                $.ajax({
                    url: '/users/wishlist',
                    method: 'GET',
                    success: function(data) {
                        $('#wishlist-count').text(data.length);
                    },
                    error: function(error) {
                        console.log('Error:', error);
                    }
                });
            }
            updateWishlistCount();

            $('.wishlist-icon').hover(
                function() {
                    if (!$(this).hasClass('clicked')) {
                        $(this).toggleClass('fa-heart-o fa-heart');
                    }
                },
                function() {
                    if (!$(this).hasClass('clicked')) {
                        $(this).removeClass('fa-heart').addClass('fa-heart-o');
                    }
                }
            );

            $('.wishlist-btn').on('click', function() {
                var productId = $(this).data('product-id');
                var productSlug = $(this).data('product-slug');
                var icon = $(this).find('.wishlist-icon');
                var productCard = $(this).closest('.col');

                $.ajax({
                    url: '/products/wishlist/toggle/' + productId,
                    method: 'POST',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        if (data.status === 'added') {
                            icon.removeClass('fa-heart-o text-secondary').addClass('fa-heart text-danger clicked');
                        } else {
                            icon.removeClass('fa-heart text-danger clicked').addClass('fa-heart-o text-secondary');
                            if ($('#wishlist-container').length) {
                                productCard.fadeOut(300, function() { $(this).remove(); });
                            }
                        }
                        updateWishlistCount();

                    },
                    error: function(error) {
                        console.log('Error:', error);
                    }
                });
            });
        });
    </script>
@endsection
