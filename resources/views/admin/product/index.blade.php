@extends('admin.layout.app')

@section('content')
        <div class="page-header">
            <h1>All Products</h1>
        </div>
        <div class="input-group">
            <form action="{{ route('admin.search') }}" method="get" class="w-25 d-flex">
                <input type="search" class="form-control rounded" placeholder="Search" name="search" />
                <button class="btn btn-outline-primary d-inline" data-mdb-ripple-init>search</button>
            </form>
        </div>
        <div class="d-flex justify-content-center p-4">
            <table class="table table-bordered text-white w-100 text-center">
                <tr>
                    <th scope="col" class="bg-info font-weight-bold">Product title</th>
                    <th scope="col" class="bg-info font-weight-bold">Product price</th>
                    <th scope="col" class="bg-info font-weight-bold">Product description</th>
                    <th scope="col" class="bg-info font-weight-bold">Category</th>
                    <th scope="col" class="bg-info font-weight-bold">Product image</th>
                    <th scope="col" class="bg-info font-weight-bold">Action</th>
                </tr>
                @foreach ($products as $product)
                <tr>
                    <td class="align-middle">{{ $product->title }}</td>
                    <td class="align-middle">${{ $product->price }}</td>
                    <td class="align-middle">{{ Str::limit($product->description, 20, '...')  }}</td>
                    <td class="align-middle">{{ $product->category->name }}</td>
                    <td><img src="{{ asset('storage/' . $product->image) }}" alt="" width="80" height="80"></td>
                    <td class="align-middle">
                        <form class="d-inline"
                              action="{{ route('admin.destroyProduct', $product->id) }}"
                              method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger delete w-25">Delete</button>
                        </form>
                        <a href="{{ route('admin.editProduct', $product->id) }}" class="btn btn-info w-25">Edit</a>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
        <div class="mt-6 p-4">
            {{$products->links()}}
        </div>
@endsection
