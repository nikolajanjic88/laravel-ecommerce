<div class="col-lg-5">
    <div class="card bg-primary text-white rounded-3">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="mb-0">Order details</h5>
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
            <a href="{{ route('payment.index') }}" class="btn btn-success btn-block btn-lg" style="cursor: pointer">
                <div class="d-flex justify-content-between">
                    <span>${{ $subTotal }}</span>
                    <span>Checkout<i class="fas fa-long-arrow-alt-right ms-2"></i></span>
                </div>
            </a>
        </div>
    </div>
</div>
