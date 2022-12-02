
@extends('app')

@section('title' , 'All Products')

@section('content')
    <h1 class="text-center mt-5">All Products {{ $products->count() }}</h1>

    <a class="btn btn-sm w-10 btn-primary" href="{{ route('products.create') }}">Create New Product</a>
    <a class="btn btn-sm w-10 btn-info mt-3" href="{{ route('products.archived') }}">Archived</a>

    @if(session()->has('message'))
        <div class="alert mt-3 alert-success">{{ session()->get('message') }}</div>
    @endif

    <table class="table mt-5 table-borderd">
        <thead>
            <th>ID</th>
            <th>Name</th>
            <th>Description</th>
            <th>Stock Quantity</th>
            <th>Price</th>
            <th>Edit</th>
            <th>Delete</th>
        </thead>
        <tbody>

            @foreach($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->description }}</td>
                    <td>{{ $product->stock_quantity }}</td>
                    <td>{{ $product->price }}</td>
                    <td>
                        @if($product->trashed())
                            <a class="btn btn-primary" href="{{ url('products/' . $product->id . '/restore') }}">Restore </a>
                        @else
                            <a class="btn btn-primary" href="{{ route('products.edit' , $product->id ) }}">Edit </a>
                        @endif
                    </td>
                    <td>
                        <form method="post" action="{{ route('products.destroy',  $product->id )}}">
                            @csrf
                            @method('DELETE')
                            <button onclick="confirm('Are You Sure?')" type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    </div>
@endsection
