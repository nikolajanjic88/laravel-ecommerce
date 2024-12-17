<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
   public function index()
    {
        $users = User::where('usertype', 'user')->count();
        $products = Product::count();
        $orders = OrderDetail::count();
        $deliveredOrders = Order::where('status', 'delivered')->count();

        return view('admin.index', compact('users', 'products', 'orders', 'deliveredOrders'));
    }

    public function getAllCategories()
    {
        $categories = Category::get();
        return view('admin.category.category', compact('categories'));
    }

    public function editCategory(Category $category)
    {
        return view('admin.category.edit', compact('category'));
    }

    public function storeCategory(Request $request)
    {
        $formFields = $request->validate([
            'name' => 'required|max:255',
        ]);

        Category::create($formFields);

        toastr()->closeButton()->success('Category added successfully');

        return redirect()->back();
    }

    public function updateCategory(Category $category, Request $request)
    {
        $formFields = $request->validate([
            'name' => 'required|max:255',
        ]);

        $category->update($formFields);

        toastr()->closeButton()->success('Category updated successfully');

        return redirect('/admin/category');
    }

    public function destroyCategory(Category $category)
    {
        $category->delete();

        toastr()->closeButton()->success('Category deleted successfully');

        return redirect()->back();
    }

    public function getAllProducts()
    {
        $products = Product::latest()->paginate(5);

        return view('admin.product.index', compact('products'));
    }

    public function search(Request $request)
    {
        $term = $request->search;

        $products = Product::whereHas('category', function($query) use($term) {
                                        $query->where('name', 'like', '%'.$term.'%');
                                    })
                                    ->orWhere('title', 'LIKE', '%' . $term . '%')
                                    ->orWhere('price', 'LIKE', '%' . $term . '%')
                                    ->paginate(5);

        return view('admin.product.index', compact('products'));
    }

    public function createProduct()
    {
        $categories = Category::all();

        return view('admin.product.create', compact('categories'));
    }

    public function storeProduct(Request $request)
    {
        $formFields = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'price' => 'required|numeric|gt:0',
            'image' => 'required|file|max:3000|mimes:png,jpg,webp',
            'category_id' => 'required'
        ]);

        if($request->hasFile('image')) {
            $formFields['image'] = $request->file('image')->store('products', 'public');
        }

        Product::create($formFields);

        toastr()->closeButton()->success('Category added successfully');

        return redirect('/admin/product');
    }

    public function editProduct(Product $product, Category $category)
    {
        $categories = Category::all();
        return view('admin.product.edit', compact('product', 'categories'));
    }

    public function updateProduct(Product $product, Request $request)
    {
        $formFields = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'price' => 'required|numeric|gt:0',
            'category_id' => 'required',
            'image' => 'file|max:3000|mimes:png,jpg,webp'
        ]);

        if($request->hasFile('image')) {
            Storage::disk('public')->delete($product->image);
            $formFields['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($formFields);

        toastr()->closeButton()->success('Product updated successfully');

        return redirect('/admin/product');
    }

    public function destroyProduct(Product $product)
    {
        $product->delete();

        if($product->image)
        {
            Storage::disk('public')->delete($product->image);
        }

        toastr()->closeButton()->success('Product deleted successfully');

        return redirect()->back();
    }

    public function indexOrders()
    {
        $orders = Order::latest()->paginate(5);

        return view('admin.order.index', compact('orders'));
    }

    public function updateOrderStatus(Order $order, Request $request)
    {
        switch ($request->input('action'))
        {
            case 'on_the_way':
                $order->status = 'On The Way';
                break;

            case 'delivered':
                $order->status = 'Delivered';
                break;
        }

        $order->update();

        toastr()->closeButton()->success('Order status updated successfully');
        return redirect()->back();
    }

}
