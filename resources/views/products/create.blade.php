@extends('app')

@section('title' , 'Create New Product')

@section('content')
    <h1 class="text-center">Create New Product</h1>

    <form class="row" action="{{ route('products.store') }}" method="post">

        @csrf

        <div class="col-6">
        <input type="text" class="form-control" name="name" placeholder="Product Name" aria-label="Product Name" value="{{old('name')}}">
        @error('name')
            <p class="text-danger">{{ $message }}</p>
        @enderror
        </div>

        <div class="col-6">
            <input type="number" class="form-control" name="price" placeholder="Price" aria-label="Price" value="{{old('price')}}">
            @error('price')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>

        <div class="col-6 mt-4">
            <input type="number" class="form-control" name="stock_quantity" placeholder="Stock Quantity" aria-label="Stock Quantity" value="{{old('stock_quantity')}}">
            @error('stock_quantity')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>

        <div class="col-6 mt-4">
        <textarea class="form-control" placeholder="Description" name="description" aria-label="Description">{{old('description')}}</textarea>
        @error('description')
            <p class="text-danger">{{ $message }}</p>
        @enderror
        </div>


        <button type="submit" class="btn btn-success mt-3 w-auto">Save</button>
    </form>
@endsection
