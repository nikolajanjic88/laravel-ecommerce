@extends('home.layout.layout')

@section('content')
<section class="h-100 gradient-custom">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            @if (count($orders) > 0)
                @foreach ($orders as $order)
                <div class="col-lg-10 col-xl-8 mb-5">
                    <div class="card" style="border-radius: 10px;">
                        <div class="card-header px-4 py-5">
                            <h5 class="text-muted mb-0">Thanks for your Order, <span style="color: #4da0ee;">{{ Auth::user()->name }}</span>!</h5>
                        </div>
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <p class="lead fw-normal mb-0" style="color: #a8729a;">Receipt</p>
                            </div>
                            @foreach ($order->orders as $item)
                            <div class="card shadow-0 border mb-4">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <img src="{{ asset('storage/' . $item->product->image) }}"
                                            class="img-fluid" width="60">
                                            </div>
                                        <div class="col-md-3 text-center d-flex justify-content-center align-items-center">
                                            <p class="text-muted mb-0">{{ $item->product->title }}</p>
                                        </div>
                                        <div class="col-md-3 text-center d-flex justify-content-center align-items-center">
                                            <p class="text-muted mb-0 small">Qty: {{ $item->quantity }}</p>
                                        </div>
                                        <div class="col-md-3 text-center d-flex justify-content-center align-items-center">
                                            <p class="text-muted mb-0 small">${{ $item->quantity * $item->product->price }}</p>
                                        </div>
                                    </div>
                                    <hr class="mb-4" style="background-color: #e0e0e0; opacity: 1;">
                                    <div class="row d-flex align-items-center">
                                        <div class="col-md-2">
                                            <p class="text-muted mb-0 small">Track Order</p>
                                        </div>
                                        <div class="col-md-10">
                                            <?php
                                                $width = '33.33%';
                                                $bgColor = 'bg-warning';
                                                if($item->status == 'Delivered')
                                                {
                                                    $width = '100%';
                                                    $bgColor = 'bg-success';
                                                }
                                                if($item->status == 'On The Way')
                                                {
                                                    $width = '66.66%';
                                                    $bgColor = 'bg-info';
                                                }
                                            ?>
                                        <div class="progress" style="height: 6px; border-radius: 16px;">
                                            <div class="progress-bar {{ $bgColor }}" role="progressbar"
                                                style="width: {{ $width }}; border-radius: 16px;" aria-valuenow="65"
                                                aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <div class="d-flex justify-content-around mb-1">
                                                <p class="text-muted mt-1 mb-0 small ms-xl-5">Ordered</p>
                                                <p class="text-muted mt-1 mb-0 small ms-xl-5">On The Way</p>
                                                <p class="text-muted mt-1 mb-0 small ms-xl-5">Delivered</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            <div class="d-flex justify-content-between pt-2">
                                <p class="fw-bold mb-0">Order Details</p>
                                <p class="text-muted mb-0"><span class="fw-bold me-4">Total {{ $order->total }}</span> $</p>
                            </div>
                            <div class="d-flex justify-content-between pt-2">
                                <p class="text-muted mb-0">Invoice Number : {{ $order->id }}</p>
                                <p class="text-muted mb-0"><span class="fw-bold me-4">Delivery Charges</span> Free</p>
                            </div>
                            <div class="d-flex justify-content-between">
                                <p class="text-muted mb-0">Invoice Date : {{ date_format($order->created_at, 'd.m.Y') }}</p>
                            </div>
                        </div>
                        <div class="card-footer border-0 px-4 py-5"
                            style="background-color: #4da0ee; border-bottom-left-radius: 10px; border-bottom-right-radius: 10px;">
                            <h5 class="d-flex align-items-center justify-content-end text-white text-uppercase mb-0">Total:
                            <span class="h2 mb-0 ms-2">${{ $order->total }}</span></h5>
                        </div>
                    </div>
                </div>
                @endforeach
            @else
                <h2>No Orders</h2>
            @endif
            <div class="col-lg-8 mt-3 p-4">
                {{$orders->links()}}
            </div>
        </div>
    </div>
</section>
@endsection
