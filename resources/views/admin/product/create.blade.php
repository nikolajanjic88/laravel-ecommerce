@extends('admin.layout.app')

@section('content')
    <div class="page-header">
        <div class="container-fluid">
            <h2 class="h5 no-margin-bottom text-center text-white font-weight-bold">Add Product</h2>
        </div>
    </div>
    <div class="d-flex justify-content-center">
        <form class="mt-4 w-50"
            action="{{ route('admin.storeProduct') }}"
            method="post"
            enctype="multipart/form-data">
            @csrf
            <div class="mb-4 w-100 d-flex flex-column justify-center align-items-center">
                <label for="title">Product title</label>
                <input class="w-50 p-2 d-block" type="text" name="title" id="title" value="{{ old('title') }}">
                @error('title')
                    <div class="text-danger text-center">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-4 w-100 d-flex flex-column justify-center align-items-center">
                <label for="description">Description: </label>
                <textarea class="w-50" name="description" id="description" cols="30" rows="5">{{ old('description') }}</textarea>
                @error('description')
                    <div class="text-danger text-center">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-4 w-100 d-flex flex-column justify-center align-items-center">
                <label for="price">Product Price</label>
                <input id="price" class="w-50 p-2 d-block" type="text" name="price" value="{{ old('price') }}">
                @error('price')
                    <div class="text-danger text-center">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-4 w-100 d-flex flex-column justify-center align-items-center">
                <label for="price">Product Image</label>
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
                <button class="btn btn-info w-25 mt-3">Add Product</button>
            </div>
        </form>
    </div>
@endsection
