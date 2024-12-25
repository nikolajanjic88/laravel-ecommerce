<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::get();

        if(session()->get('cart'))
        {
            return view('home.payment', compact('payments'));
        }

        return redirect('products');
    }

    public function store(Request $request)
    {
        $request->validate([
            'address' => 'required',
            'phone' => 'required',
            'payment' => 'required'
        ]);

        $cart = session()->get('cart');
        $total = array_reduce($cart, fn($sum, $item) => $sum + $item['price'] * $item['quantity']);

        OrderDetail::create([
            'user_id' => Auth::user()->id,
            'payment_id' => $request->payment,
            'address' => $request->address,
            'phone' => $request->phone,
            'total' => $total
        ]);

        $order_detail_id = OrderDetail::where('user_id', Auth::user()->id)
                                        ->orderBy('id', 'desc')
                                        ->first()->id;

        foreach($cart as $key => $item)
        {
            Order::create([
                'product_id' => $key,
                'order_detail_id' => $order_detail_id,
                'quantity' => $item['quantity']
            ]);
        }

        Session::forget('cart');

        toastr()->closeButton()->success('Order created successfully');

        return redirect('orders');
    }

}
