<?php

namespace App\Http\Controllers;

use App\Models\OrderDetail;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $user_id = Auth::user()->id;

        $orders = OrderDetail::with('orders')->where('user_id', $user_id)->latest()->paginate(1);

        return view('home.orders', compact('orders'));
    }
}
