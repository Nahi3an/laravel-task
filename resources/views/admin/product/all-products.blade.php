@extends('admin.master')

@section('content')
    <div class="container mt-4">

        <h1>Product List</h1>
        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Slug</th>
                    <th scope="col">Category</th>
                    <th scope="col">Price</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Action</th>

                </tr>
            </thead>
            <tbody>
                @php
                    $i = 0;
                @endphp
                @foreach ($products as $product)
                    <tr>
                        <th scope="row">{{ ++$i }}</th>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->slug }}</td>
                        <td>{{ $product->category->name }}</td>
                        <td>{{ $product->price }} BDT</td>
                        <td>{{ $product->quantity }}</td>
                        <td>
                            <div class="row">
                                <div class="col-md-3">
                                    <a href="{{ route('products.edit', ['product' => $product->id]) }}"
                                        class="btn btn-secondary btn-sm mt-1">
                                        Edit
                                    </a>

                                </div>
                                <div class="col-md-3">
                                    <a>
                                        <form method="POST"
                                            action="{{ route('products.destroy', ['product' => $product->id]) }}">
                                            @csrf
                                            @method('DELETE')
                                            <input type="submit" value="Delete" class="btn btn-danger btn-sm mt-1"
                                                onclick="return confirm('Are You Sure to Delete this Product?')">
                                        </form>

                                    </a>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
