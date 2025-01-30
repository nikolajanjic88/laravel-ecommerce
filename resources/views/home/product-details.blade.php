@extends('home.layout.layout')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-6 mb-4">
            <img src="{{ asset('storage/' . $product->image) }}" alt="" width="500">
        </div>
        <div class="col-md-6">
            <h2 class="mb-3">{{ $product->title }}</h2>
            <div class="mb-3">
                <span class="h4 me-2">${{ $product->price }}</span>
            </div>
            <p class="mb-4">
                {{ $product->description }}
            </p>
            <form action="{{ route('cart.store', $product->id ) }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="quantity" class="form-label">Quantity:</label>
                    <input type="number" class="form-control" id="quantity" name="quantity" value="1" min="1" style="width: 80px;">
                    @error('quantity')
                        <div class="text-danger text-center">{{ $message }}</div>
                    @enderror
                </div>
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <button class="btn btn-primary btn-lg mb-3 me-2">
                    <i class="bi bi-cart-plus"></i> Add to Cart
                </button>
            </form>
        </div>
    </div>
    @include('home.inc.comments')
</div>
@endsection
