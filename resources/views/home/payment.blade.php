@extends('home.layout.layout')

@section('content')
<div class="container">
    <div class="row d-flex justify-content-center m-5 p-4">
        <div class="col-lg-12">
            <div class="card bg-info text-white rounded-3">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="mb-0">Order details</h5>
                    </div>
                    <form action="{{ route('payment.store') }}" class="mt-4" method="POST">
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
                        <p>Chose payment method</p>
                        @foreach ($payments as $payment)
                            <input type="radio" name="payment" value="{{ $payment->id }}" id="payment{{ $payment->id }}"> {{ $payment->type }}<br>
                        @endforeach
                        @error('payment')
                            <div class="text-danger text-left text-sm">{{ $message }}</div>
                        @enderror
                        <div style="display: none" id="payment-card" class="col-md-12 mt-4 bg-dark p-4">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <div class="form-group">
                                        <label for="cardNumber">
                                            CARD NUMBER</label>
                                        <div class="input-group">
                                            <input name="card-number" type="text" class="form-control" id="cardNumber" placeholder="Valid Card Number"/>
                                            <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-7 col-md-7">
                                            <div class="form-group">
                                                <label for="expityMonth">
                                                    EXPIRY DATE</label>
                                                <div class="col-xs-6 col-lg-6 pl-ziro">
                                                    <input name="mm" type="text" class="form-control" id="expityMonth" placeholder="MM" />
                                                </div>
                                                <div class="col-xs-6 col-lg-6 pl-ziro mt-2">
                                                    <input name="yy" type="text" class="form-control" id="expityYear" placeholder="YY" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xs-5 col-md-5 pull-right">
                                            <div class="form-group">
                                                <label for="cvCode">
                                                    CV CODE</label>
                                                <input name="cv" type="password" class="form-control" id="cvCode" placeholder="CV" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center">
                            <button class="btn btn-warning w-50 btn-block btn-lg mt-2">
                                <span>Order<i class="fas fa-long-arrow-alt-right ms-2"></i></span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection