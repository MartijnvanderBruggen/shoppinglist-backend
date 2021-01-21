<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Shoppinglist;
use Illuminate\Support\Facades\Log;

class ShoppinglistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shoppinglists = Shoppinglist::get()->toJson();
        return response()->json($shoppinglists, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $request->validate([
          'price' => 'required',
          'product' => 'required',
          'quantity' => 'required'
      ]);

      Shoppinglist::create($request->all());

      return response()->json('Item added succesfully.', 200);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(Shoppinglist::where('id', $id)->exists())
        {
          $list = Shoppinglist::get('id', $id)->get()->toJson();
          return response()->json($list, 200);
        } else {
          return response()->json('not found!', 401);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Shoppinglist $shoppinglist)
    {
        $request->validate([
          'price' => 'required',
          'product' => 'required',
          'quantity' => 'required'
        ]);
        $item = Shoppinglist::find($request->id);
        $item->update($request->only(['price','quantity','product']));
        return response()->json('Item updated succesfully.', 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      try {
        $item = Shoppinglist::find($id);
        $item->delete();
        return response()->json('The item has been removed',200);
      } catch (\Exception $e) {
        return response()->json($e);
      }
    }
}
