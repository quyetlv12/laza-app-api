<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favourate;

class FavourateController extends Controller
{
    public function index()
    {
        $list = Favourate::with('Products')->get();
        return $list;
        // return Favourate::all();
    }

    public function store(Request $request)
    {
        $item = new Favourate([
            'product_id' => $request->input('product_id'),
        ]);

        $item->save();

        return response()->json($item, 201);
    }

    public function show($id)
    {
        return Favourate::find($id);
    }

    public function update(Request $request, $id)
    {
        $product = Favourate::find($id);
        $product->update($request->all());

        return response()->json($product, 200);
    }

    public function destroy($id)
    {
        $product = Favourate::find($id);
        $product->delete();

        return response()->json('Favourate deleted successfully', 200);
    }
}
