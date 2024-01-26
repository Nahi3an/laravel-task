@extends('admin.master')

@section('content')
    <div class="container mt-4">

        <h1>Product List</h1>
        <div class="row">
            <div class="col-6">
                <form action="{{ route('products.import') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <label for="file">Choose file to import:</label>
                    <input type="file" name="file" accept=".csv, .xls, .xlsx">
                    <button type="submit" class="btn btn-success btn-sm mt-1">Import Products</button>
                </form>
            </div>
            <div class="col-6">
                <!-- Export Button -->
                <a href="{{ route('products.export') }}" class="btn btn-warning btn-sm mt-1">
                    Export
                </a>
            </div>
        </div>
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
                        <td>{{ $product->category ? $product->category->name : 'Not Found' }}</td>
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
                                <div class="col-md-3">
                                    {{-- product.purchase --}}
                                    <form method="POST" action="{{ route('product.purchase') }}">
                                        @csrf
                                        <input type="hidden" name='product_id' value="{{ $product->id }}">
                                        @if ($product->quantity > 0)
                                            <input type="submit" value="Purchase" class="btn btn-info btn-sm mt-1"
                                                onclick="return confirm('Are You Sure to Purchase this Product?')">
                                        @else
                                            <input type="submit" value="Purchase" class="btn btn-danger btn-sm mt-1"
                                                @disabled(true)>
                                        @endif

                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
