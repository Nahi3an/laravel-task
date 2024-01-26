@extends('admin.master')

@section('content')
    <div class="container mt-4">
        <h1>Add Product</h1>
        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
        <form method="post" action="{{ route('products.store') }}" class="mt-3">
            @csrf

            <div class="form-group mt-2">
                <label for="product_name">Product Name</label>
                <input type="text" class="form-control" id="product_name" name="name">
            </div>
            @if ($errors->has('name'))
                <div class="alert alert-danger mt-1">{{ $errors->first('name') }}</div>
            @endif
            <div class="form-group mt-2">
                <label for="price">Price (BDT)</label>
                <div class="input-group">
                    <input type="number" class="form-control" id="price" name="price">
                </div>
            </div>
            @if ($errors->has('price'))
                <div class="alert alert-danger mt-1">{{ $errors->first('price') }}</div>
            @endif

            <div class="form-group mt-2">
                <label for="quantity">Quantity</label>
                <input type="number" class="form-control" id="quantity" name="quantity">
            </div>

            @if ($errors->has('quantity'))
                <div class="alert alert-danger mt-1">{{ $errors->first('quantity') }}</div>
            @endif
            <div class="form-group mt-2">
                <label for="category">Category</label>
                <select class="form-control" id="category" name="category_id">
                    <option value="" disabled selected>Select a category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            @if ($errors->has('category_id'))
                <div class="alert alert-danger mt-1">{{ $errors->first('category_id') }}</div>
            @endif



            <button type="submit" class="btn btn-primary mt-2">Add Product</button>
        </form>
    </div>
@endsection
