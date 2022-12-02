@extends('app')

@section('title' , 'Update ' . $product->name)

@section('content')
    <h1 class="text-center">Update {{$product->name}}</h1>

    <form class="row" action="{{ route('products.update' , $product) }}" method="post">

        @csrf

        @method('PUT')

        <div class="col-6">
        <input type="text" class="form-control" name="name" placeholder="Product Name" aria-label="Product Name" value="{{old('name', $product->name)}}">
        @error('name')
            <p class="text-danger">{{ $message }}</p>
        @enderror
        </div>

        <div class="col-6">
            <input type="number" class="form-control" name="price" placeholder="Price" aria-label="Price" value="{{old('price', $product->price)}}">
            @error('price')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>

        <div class="col-6 mt-4">
            <input type="number" class="form-control" name="stock_quantity" placeholder="Stock Quantity" aria-label="Stock Quantity" value="{{old('stock_quantity', $product->stock_quantity)}}">
            @error('stock_quantity')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>

        <div class="col-6 mt-4">
        <textarea class="form-control" placeholder="Description" name="description" aria-label="Description">{{old('description', $product->description)}}</textarea>
        @error('description')
            <p class="text-danger">{{ $message }}</p>
        @enderror
        </div>


        <button type="submit" class="btn btn-success mt-3 w-auto">Save</button>
    </form>
@endsection
