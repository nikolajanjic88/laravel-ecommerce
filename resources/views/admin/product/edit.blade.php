@extends('admin.layout.app')

@section('content')
    <div class="page-header">
        <div class="container-fluid">
            <h2 class="h5 no-margin-bottom text-center text-white font-weight-bold">Edit Product</h2>
        </div>
    </div>
    <div class="d-flex justify-content-center flex-column align-items-center">
        <form class="mt-4 w-50"
            action="{{ route('admin.updateProduct', $product->id) }}"
            method="post"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-4 w-100 d-flex flex-column justify-center align-items-center">
                <label for="title">Product title</label>
                <input class="w-50 p-2 d-block" type="text" name="title" id="title" value="{{ $product->title }}">
                @error('title')
                    <div class="text-danger text-center">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-4 w-100 d-flex flex-column justify-center align-items-center">
                <label for="description">Description: </label>
                <textarea class="w-50" name="description" id="description" cols="30" rows="5">{{ $product->description }}</textarea>
                @error('description')
                    <div class="text-danger text-center">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-4 w-100 d-flex flex-column justify-center align-items-center">
                <label for="price">Product Price</label>
                <input id="price" class="w-50 p-2 d-block" type="text" name="price" value="{{ $product->price }}">
                @error('price')
                    <div class="text-danger text-center">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-4 w-100 d-flex flex-column justify-center align-items-center">
                <label for="price">Current Image</label>
                <img src="{{ asset('storage/' . $product->image) }}" alt="" width="120" height="120">
                <input id="image" class="w-50 p-2 d-block" type="file" name="image">
                @error('image')
                    <div class="text-danger text-center">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-4 w-100 d-flex flex-column justify-center align-items-center">
                <label for="category">Select Category: </label>
                <select name="category_id" id="category">
                    <option value="">Chose Category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category_id')
                    <div class="text-danger text-center">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-4 w-100 d-flex flex-column justify-center align-items-center">
                <button class="btn btn-info w-25 mt-3">Update Product</button>
            </div>
            <div class="mb-4 w-100 d-flex flex-column justify-center align-items-center">
                <a href="{{ route('admin.product') }}" class="btn btn-secondary w-25 mt-3">Cancel</a>
            </div>
        </form>
    </div>
@endsection
