<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    public function index()
    {
        $user_id = Auth::user()->id;

        $orders = OrderDetail::with('orders')->where('user_id', $user_id)->get();

        return view('home.orders', compact('orders'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'address' => 'required',
            'phone' => 'required',
        ]);

        $cart = session()->get('cart');
        $total = array_reduce($cart, fn($sum, $item) => $sum + $item['price'] * $item['quantity']);

        OrderDetail::create([
            'user_id' => Auth::user()->id,
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
