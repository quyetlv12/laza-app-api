<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $list = Order::with('cart')->get();
        return response()->json($list , 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        if (Auth::check()) {
            # code...
            $model =  Order::create($request->all());
            return response()->json($model , 200);
        }else{
            return response()->json(['message' => 'bạn chưa đăng nhập'] , 403);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $order = Order::find($id);
        $order->delete();
        return response()->json(['message' => 'Xoá đơn hàng thành công !'] , 200);
    }
    public function updateStatus(Request $request){
        $rule = [
            'status' => 'required|in:WAITING_COMFIRM,CONFIRM,TRANSPORT,DELIVERING,RECEIVED'
        ];

        $validator = Validator::make($request->all() , $rule);
        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json(['message' => 'Validation failed', 'errors' => $errors], 400);
        }else{
            $id = $request->id;
            $item = Order::find($id);
            $data = [
                'status' => $request->status
            ];
            $item->update($data);
            return response()->json($item , 200);
        }
     
    }
}
