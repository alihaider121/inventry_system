<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductStoreRequest;
use App\Models\Product;

use Illuminate\Http\Request;


class ProductController extends Controller
{

    public function index()
    {

        $products=Product::latest()->paginate(2);

        return view('product.index',['products'=>$products] );
    }


    public function create()
    {
        return view('product.create');
    }


    public function store(ProductStoreRequest $productStoreRequest)
    {
        $data = $productStoreRequest->all();

        // dd($data);

       $check= Product::create([
           'name'=>$data['name'],
           'cost'=>$data['cost'],
           'price'=>$data['price'],
           'quantity'=>$data['quantity'],
           'brand'=>$data['brand'],
        ]);
        // dd($check);

        return ($check)? redirect()->route("product.index")->withSuccess('Product added succesfully'):redirect("register")->withErrors('Try again!');
    }


    public function show($id)
    {
        $product=Product::find($id);
        return $product;
        // return view('product.show',['product'=>$product] );

    }

    public function edit($id)
    {
        $product=Product::find($id);
        dd($product);

        //
    }

    public function update(Request $request, Product $product)
    {
        //
    }


    public function destroy($id)
    {
        $product=Product::find($id);
        $check= $product->delete();

        return ($check)? redirect()->route("product.index")->withSuccess('Successfully deleted'):redirect()->route("product.index")->withErrors('Unable to delete!');

    }
}
