@extends('admin.layout.app')

@section('content')
        <div class="page-header">
            <div class="container-fluid">
                <h2 class="h5 no-margin-bottom text-center text-white font-weight-bold">Add Category</h2>
                <form class="mt-4 d-flex justify-content-center"
                    action="{{ route('admin.storeCategory') }}"
                    method="post">
                    @csrf
                    <input class="w-25 p-1" type="text" name="name" value="{{ old('name') }}">
                    <button class="btn btn-primary">Add Category</button>
                </form>
                @error('name')
                    <div class="text-danger text-center">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="d-flex justify-content-center">
            <table class="table table-bordered text-white w-50 text-center">
                <tr>
                    <th scope="col" class="bg-info font-weight-bold">Category name</th>
                    <th scope="col" class="bg-info font-weight-bold">Action</th>
                </tr>
                @foreach ($categories as $category)
                <tr>
                    <td>{{ $category->name }}</td>
                    <td>
                        <form class="d-inline" id="delete-category"
                              action="{{ route('admin.destroyCategory', $category->id) }}"
                              method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger delete w-25">Delete</button>
                        </form>
                        <a href="{{ route('admin.editCategory', $category->id) }}" class="btn btn-info w-25">Edit</a>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
@endsection
