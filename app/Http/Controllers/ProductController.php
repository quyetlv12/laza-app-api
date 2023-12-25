<?php

namespace App\Http\Controllers;

use App\Models\Comments;
use App\Models\Product;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('comments' , 'categories')->get();
        $products = $products->map(function ($record) {
            $sizeArray = json_decode($record->size, true);
            $record->sizeArray = $sizeArray;
            return $record;
        });    
        return response()->json($products , 200);
    }
    public function store(Request $request)
    {
        if (Auth::check()) {
            # code...
            $product = new Product([
                'name' => $request->input('name'),
                'price' => $request->input('price'),
                'description' => $request->input('description'),
                'images' => $request->input('images'),
                'thumbnail' => $request->input('thumbnail'),
                'size' => json_encode($request->input('size')),
                'comment_id' => $request->input('comment_id'),
                'cate_id' => $request->input('cate_id')
            ]);
            $product->save();
            return response()->json($product, 201);
        }else{
            return response()->json(['message' => "Bạn chưa đăng nhập"] , 400);
        }
       
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
    public function getcomments($id){
        $comments = Comments::where('product_id' , $id)->get();
        return response()->json($comments , 200);
    }
}
