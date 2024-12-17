<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    public function index()
    {
        $products = Product::latest()->take(4)->get();

        return view('home.index', compact('products'));
    }

    public function products()
    {
        $products = Product::latest()->paginate(8);

        $categories = Category::get();

        return view('home.products', compact('products', 'categories'));
    }

    public function show(Product $product)
    {
        $comments = Comment::where('product_id', $product->id)->latest()->paginate(3);

        return view('home.product-details', compact('product', 'comments'));
    }

    public function search(Request $request)
    {
        $search = $request->product_name;

        $categories = Category::all();

        $products = Product::Where('title', 'LIKE', '%' . $search . '%')->paginate(8);

        return view('home.products', compact('products', 'categories'));
    }

    public function filter(Category $category)
    {
        $categories = Category::get();

        $products = Product::whereHas('category', function($query) use($category) {
                            $query->where('id', $category->id);
                            })->paginate(8);

        return view('home.products', compact('products', 'categories'));
    }

    public function postComment(Request $request)
    {
        $request->validate([
            'body' => 'required'
        ]);

        Comment::create([
            'body' => $request->body,
            'product_id' => $request->product_id,
            'user_id' => Auth::user()->id
        ]);

        toastr()->closeButton()->success('Comment posted successfully');

        return redirect()->back();
    }

    public function deleteComment(Comment $comment)
    {
        $comment->delete();

        toastr()->closeButton()->success('Comment deleted successfully');

        return redirect()->back();
    }

}
