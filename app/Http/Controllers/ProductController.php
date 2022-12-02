<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return view('products.index' , [
            'products' => $products
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'unique:products' , 'max:255'],
            'description' => ['required', 'string', 'max:500'],
            'price' => ['required', 'numeric'],
            'stock_quantity' => ['required', 'integer'],
        ]);
        $product = Product::create($data);
        session()->flash('message' , $product->name .' created successfully');
        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        dd($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);

        return view('products.edit', [
            'product' => $product
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => ['required', 'string', Rule::unique('products')->ignore($id) , 'max:255'],
            'description' => ['required', 'string', 'max:500'],
            'price' => ['required', 'numeric'],
            'stock_quantity' => ['required', 'integer'],
        ]);
        $product = Product::findOrFail($id);
        $product->update($data);
        session()->flash('message' , $product->name .' updated successfully');
        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        session()->flash('message' , $product->name .' deleted successfully');
        return redirect()->route('products.index');
    }

    /**
     * Display softdeleted products
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function archive()
    {
        $products = Product::onlyTrashed()->get();
        return view('products.index' , [
            'products' => $products
        ]);
    }


    /**
     * restore softdeleted products
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        $product = Product::onlyTrashed()->findOrFail($id);
        $product->restore();
        session()->flash('message' , $product->name .' restored successfully');
        return redirect()->route('products.index');
    }
}
