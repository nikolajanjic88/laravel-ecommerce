@extends('home.layout.layout')

@section('content')
<section class="h-100 h-custom" style="background-color: #eee;">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col">
                <div class="card">
                    <div class="card-body p-4">
                        <div class="row">
                            <div class="col-lg-7">
                                <h5 class="mb-3"><a href="{{ route('products') }}" class="text-body">
                                    <i class="fas fa-long-arrow-alt-left me-2"></i>Continue shopping</a>
                                </h5>
                                <hr>
                                @if(session('cart'))
                                    @foreach (session('cart') as $id => $product)
                                        <div class="card mb-3">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between">
                                                    <div class="d-flex flex-row align-items-center">
                                                        <div>
                                                            <img src="{{ asset('storage/' . $product['image']) }}"
                                                                 class="img-fluid rounded-3" alt="Shopping item" style="width: 65px;">
                                                        </div>
                                                        <div class="ms-3 ml-2">
                                                            <a href="{{ route('product.details', $id) }}"><h5>{{ $product['title'] }}</h5></a>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex flex-row align-items-center">
                                                        <div style="width: 130px;">
                                                            <h5 class="fw-normal mb-0">Quantity: {{ $product['quantity'] }}</h5>
                                                        </div>
                                                        <div style="width: 100px;">
                                                            <h5 class="mb-0">${{ $product['price'] *  $product['quantity']}}</h5>
                                                        </div>
                                                        <form action="{{ route('cart.destroy', $id) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <input type="hidden" name="id" value="{{ $id }}">
                                                            <button class="delete border-0">
                                                                <i class="bi bi-trash"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                                                                <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                                                                </svg></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                <h2>No items</h2>
                                @endif
                            </div>
                            @if(session('cart'))
                            <div class="col-lg-5">
                                <div class="card bg-primary text-white rounded-3">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center mb-4">
                                            <h5 class="mb-0">Order details</h5>
                                        </div>
                                        <form action="{{ route('order') }}" class="mt-4" method="POST">
                                            @csrf
                                            <div data-mdb-input-init class="form-outline form-white mb-4">
                                                <input type="hidden" name="name" id="typeName" class="form-control form-control-lg"
                                                        value="{{ Auth::user()->name }}"/>
                                            </div>
                                            <div data-mdb-input-init class="form-outline form-white mb-4">
                                                <input type="text" name="address" id="typeText" class="form-control form-control-lg"
                                                        value="{{ Auth::user()->address }}"/>
                                                <label class="form-label" for="typeText">Address</label>
                                                @error('address')
                                                    <div class="text-danger text-center">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div data-mdb-input-init class="form-outline form-white mb-4">
                                                <input type="text" name="phone" id="phone" class="form-control form-control-lg"
                                                            value="{{ Auth::user()->phone }}"/>
                                                <label class="form-label" for="phone">Phone</label>
                                                @error('phone')
                                                    <div class="text-danger text-center">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <hr class="my-4">
                                            <div class="d-flex justify-content-between">
                                                <p class="mb-2">Subtotal</p>
                                                <?php $subTotal = 0;
                                                    foreach (session('cart') as $id => $product)
                                                    {
                                                        $subTotal += $product['price'] * $product['quantity'];
                                                    }
                                                ?>
                                                <p class="mb-2">${{ $subTotal }}</p>
                                            </div>
                                            <div class="d-flex justify-content-between">
                                                <p class="mb-2">Shipping</p>
                                                <p class="mb-2">Free</p>
                                            </div>
                                            <div class="d-flex justify-content-between mb-4">
                                                <p class="mb-2">Total</p>
                                                <p class="mb-2">${{ $subTotal }}</p>
                                            </div>
                                            <button class="btn btn-info btn-block btn-lg">
                                                <div class="d-flex justify-content-between">
                                                    <span>${{ $subTotal }}</span>
                                                    <span>Place Order<i class="fas fa-long-arrow-alt-right ms-2"></i></span>
                                                </div>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection