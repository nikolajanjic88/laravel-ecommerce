<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        return view('home.cart');
    }

    public function store(Request $request, Product $product)
    {
        $request->validate([
            'quantity' => 'required|numeric|gt:0|max:100',
        ]);

        $cart = session()->get('cart');

        if(!$cart)
        {
            $cart = [
                    $product->id => [
                        "title" => $product->title,
                        "quantity" => $request->quantity,
                        "price" => $product->price,
                        "image" => $product->image
                    ]
            ];

            session()->put('cart', $cart);

            return redirect('/cart');
        }

        if(isset($cart[$product->id])) {

            $cart[$product->id]['quantity'] += $request->quantity;

            session()->put('cart', $cart);

            return redirect('/cart');
        }

        $cart[$product->id] = [
            "title" => $product->title,
            "quantity" => $request->quantity,
            "price" => $product->price,
            "image" => $product->image
        ];

        session()->put('cart', $cart);

        toastr()->closeButton()->success('Product added to cart');

        return redirect('/cart');
    }

    public function destroy(Request $request)
    {
        if($request->id) {

            $cart = session()->get('cart');

            if(isset($cart[$request->id]))
            {
                unset($cart[$request->id]);

                session()->put('cart', $cart);
            }

            toastr()->closeButton()->success('Cart item deleted successfully');
        }

        return redirect()->back();
    }
}
