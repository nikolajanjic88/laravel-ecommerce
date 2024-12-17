<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/search/products', [HomeController::class, 'search'])->name('product.search');

Route::controller(HomeController::class)->prefix('products')->group(function(){
    Route::get('/', 'products')->name('products');
    Route::get('/{product}', 'show')->name('product.details');
    Route::get('/category/{category}', 'filter')->name('product.filter');
    Route::post('/comment/{product}', 'postComment')->middleware(['auth', 'verified'])->name('product.comment');
    Route::delete('/comment/{comment}', 'deleteComment')->middleware(['auth', 'verified'])->name('product.delete-comment');
});

Route::middleware(['auth', 'verified'])->controller(CartController::class)->prefix('cart')->group(function(){
    Route::get('/', 'index')->name('cart');
    Route::post('/{product}', 'store')->name('cart.store');
    Route::delete('/{cart}', 'destroy')->name('cart.destroy');
});

Route::middleware(['auth', 'verified'])->controller(OrderController::class)->group(function(){
    Route::post('/order', 'store')->middleware(['auth', 'verified'])->name('order');
    Route::get('/orders', 'index')->middleware(['auth', 'verified'])->name('orders');
});


Route::middleware(['auth', 'admin'])->controller(AdminController::class)->prefix('admin')->group(function(){
    Route::get('/dashboard', 'index')->name('admin.index');
    Route::get('/category', 'getAllCategories')->name('admin.category');
    Route::get('/category/{category}', 'editCategory')->name('admin.editCategory');
    Route::post('/category', 'storeCategory')->name('admin.storeCategory');
    Route::put('/category/{category}', 'updateCategory')->name('admin.updateCategory');
    Route::delete('/category/{category}', 'destroyCategory')->name('admin.destroyCategory');
    Route::get('/product', 'getAllProducts')->name('admin.product');
    Route::get('/product/create', 'createProduct')->name('admin.createProduct');
    Route::post('/product/create', 'storeProduct')->name('admin.storeProduct');
    Route::get('/product/edit/{product}', 'editProduct')->name('admin.editProduct');
    Route::put('/product/edit/{product}', 'updateProduct')->name('admin.updateProduct');
    Route::delete('/product/{product}', 'destroyProduct')->name('admin.destroyProduct');
    Route::get('/product/search', 'search')->name('admin.search');
    Route::get('/orders', 'indexOrders')->name('admin.orders');
    Route::put('/orders/status/{order}', 'updateOrderStatus')->name('admin.order.status');
});
