@extends('home.layout.layout')

@section('content')
@include('home.layout.slider')
<section class="shop_section layout_padding">
    <div class="container">
      <div class="heading_container heading_center">
        <h2>
          Latest Products
        </h2>
      </div>
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
              <div class="new">
                <span>
                  New
                </span>
              </div>
          </div>
        </div>
        @endforeach
      </div>
      <div class="btn-box">
        <a href="{{ route('products') }}">
          View All Products
        </a>
      </div>
    </div>
</section>
@include('home.layout.contact')
@endsection
