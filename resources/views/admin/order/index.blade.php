@extends('admin.layout.app')

@section('content')
    <div class="d-flex justify-content-center p-4">
        <table class="table table-bordered text-white w-100 text-center mt-5">
            <tr>
                <th scope="col" class="bg-info font-weight-bold">Customer name</th>
                <th scope="col" class="bg-info font-weight-bold">Address</th>
                <th scope="col" class="bg-info font-weight-bold">Phone</th>
                <th scope="col" class="bg-info font-weight-bold">Product</th>
                <th scope="col" class="bg-info font-weight-bold">Image</th>
                <th scope="col" class="bg-info font-weight-bold">Quantity</th>
                <th scope="col" class="bg-info font-weight-bold">Subtotal</th>
                <th scope="col" class="bg-info font-weight-bold">Status</th>
                <th scope="col" class="bg-info font-weight-bold">Action</th>
            </tr>
            @foreach ($orders as $order)
            <tr>
                <td class="align-middle">{{ $order->orderDetail->user->name }}</td>
                <td class="align-middle">{{ $order->orderDetail->address }}</td>
                <td class="align-middle">{{ $order->orderDetail->phone }}</td>
                <td class="align-middle">{{ $order->product->title }}</td>
                <td class="align-middle"><img src="{{ asset('storage/' . $order->product->image) }}" width="80" alt=""></td>
                <td class="align-middle">{{ $order->quantity }}</td>
                <td class="align-middle">${{ $order->quantity * $order->product->price }}</td>
                <?php
                    $bgColor = 'bg-warning';
                    if($order->status == 'Delivered') $bgColor = 'bg-success';
                    if($order->status == 'On The Way') $bgColor = 'bg-info';
                ?>
                <td class="align-middle"><p class="{{ $bgColor }} p-1 rounded">{{ $order->status }}</p></td>
                <td class="align-middle">
                    <form class="w-100" action="{{ route('admin.order.status', $order->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="id" value="{{ $order->id }}">
                        <button name="action" value="on_the_way" class="btn btn-info w-50 mb-3">On the Way</button>
                        <button name="action" value="delivered" class="btn btn-success w-50">Delivered</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
    <div class="mt-6 p-4">
        {{$orders->links()}}
    </div>
@endsection
