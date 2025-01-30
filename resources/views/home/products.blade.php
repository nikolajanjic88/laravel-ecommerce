@extends('home.layout.layout')

@section('content')
<section class="shop_section layout_padding">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <div class="navbar-nav">
                    <a class="nav-link" href="{{ route('products') }}">All Products</a>
                    @foreach ($categories as $category)
                        <a class="nav-link" href="{{ route('product.filter', $category->id) }}">{{ $category->name }}</a>
                    @endforeach
                </div>
            </div>
            <div class="input-group">
                <form action="{{ route('product.search') }}" method="get" class="w-75 d-flex">
                    <input type="search" class="form-control rounded" placeholder="Search" name="product_name" />
                    <button class="btn btn-outline-primary d-inline" data-mdb-ripple-init>search</button>
                </form>
            </div>
        </nav>
        <div class="row">
            @foreach ($products as $product)
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="box">
                        <div class="img-box">
                            <img src="{{ asset('storage/' . $product->image) }}" alt="">
                        </div>
                        <div class="detail-box">
                            <h6>
                            {{ $product->title }}
                            </h6>
                            <h6>
                            Price
                            <span>
                                ${{ $product->price }}
                            </span>
                            </h6>
                        </div>
                        <div>
                            <a href="{{ route('product.details', $product->id) }}" class="btn btn-info">Details</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="mt-6 p-4">
            {{$products->links()}}
        </div>
    </div>
</section>
@endsection
