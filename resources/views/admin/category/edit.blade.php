@extends('admin.layout.app')

@section('content')
        <div class="page-header">
            <div class="container-fluid">
                <h2 class="h5 no-margin-bottom text-center text-white font-weight-bold">Edit Category</h2>
            </div>
        </div>
        <div class="d-flex justify-content-center">
            <form class="mt-4 w-50 d-flex flex-column align-items-center"
                action="{{ route('admin.updateCategory', $category->id) }}"
                method="post">
                @csrf
                @method('PUT')
                <label for="name">Category name</label>
                <input class="w-50 p-2 d-block mb-1" type="text" name="name" id="name" value="{{ $category->name }}">
                @error('name')
                    <div class="text-danger text-center">{{ $message }}</div>
                @enderror
                <button class="btn btn-info w-25 mt-3">Update</button>
                <div class="mb-4 w-100 d-flex flex-column justify-center align-items-center">
                    <a href="{{ route('admin.category') }}" class="btn btn-secondary w-25 mt-3">Cancel</a>
                </div>
            </form>
        </div>
@endsection

