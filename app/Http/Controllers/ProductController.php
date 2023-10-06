<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return Product::all();
    }
    // {
    //     "name" : "sản phẩm 1",
    //     "price" : "99",
    //     "descrption" : "32132",
    //     "thumbnail" : "",
    //     "images" : "[\"http://127.0.0.1:8000/api/images/1696487477.jpg\",\"http://127.0.0.1:8000/api/images/1696487477.png\",\"http://127.0.0.1:8000/api/images/1696487477.jpg\"]"
    // }
    public function store(Request $request)
    {
        $product = new Product([
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'description' => $request->input('description'),
            'images' => $request->input('images'),
            'thumbnail' => $request->input('thumbnail'),
        ]);

        $product->save();

        return response()->json($product, 201);
    }

    public function show($id)
    {
        return Product::find($id);
    }

    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        $product->update($request->all());

        return response()->json($product, 200);
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();

        return response()->json('Product deleted successfully', 200);
    }
}
