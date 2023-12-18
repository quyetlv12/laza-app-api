<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $product = Cart::with('products')->get();
        return response()->json($product , 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $rules = [
            'size' => 'required',
            'product_id' => 'required',
            'quantity' => 'required',
        ];
    
        $customMessages = [
            'size.required' => 'Vui lòng nhập kích thước !',
            'product_id.required' => 'Vui lòng nhập mã sản phẩm !',
            'quantity.required' => 'Vui lòng nhập số lượng !',
        ];
    
        // Validate the request data with custom messages
        $validator = Validator::make($request->all(), $rules, $customMessages);
    
        // Check if validation fails
        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json(['message' => 'Validation failed', 'errors' => $errors], 422);
        }else{
              # code...
              $cart = [
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
                'size' => $request->size,
            ];
    
            return Cart::create($cart);
        } 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
       $item = Cart::with('Products')->find($id);
       if ($item) {
        return response()->json($item , 200);
       }else return response()->json('Không tìm thấy sản phẩm !' , 400); 
       
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
        //
        $product = Cart::find($id);
        $product->update($request->all());

        return response()->json($product, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $item = Cart::find($id);
        $item->delete();

        return response()->json(['message' => 'Xoá sản phẩm thành công'] , 200);
    }
}
