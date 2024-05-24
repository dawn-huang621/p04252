<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    //  確保 carts 有東西
    public function index()
    {
        $cart = DB::table('carts')->get()->first();
        if(empty($cart)){
            DB::table('carts')->insert(['created_at' => now(), 'updated_at' => now()]);
            $cart = DB::table('carts')->get()->first();
        }
        
        // 撈出 cart_id 相同的 cart_items
        $cartItems = DB::table('cart_items')->where('cart_id', $cart->id)->get();
        $cart = collect($cart);
        $cart['items'] = collect($cartItems);

        return response($cart);
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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // 透過關聯cart cartItems建立一筆資料
        $form = $request->all();
        $cart = Cart::find($form['cart_id']);
        $result = $cart->cartItems()->create(['product_id' => $form['product_id'],
                                              'quantity' => $form['quantity']]);
        
        return response()->json($result);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }
}
