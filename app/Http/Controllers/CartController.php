<?php

namespace App\Http\Controllers;

use App\Models\{Cart,Order};
use Illuminate\Http\Request;
use App\Models\{Product};

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Product $product)
    {
        $cart = session('cart', []);
        $products = Product::whereIn('id', array_keys($cart))->get();

        foreach ($products as $product) {
            $total_sum_product = $product->price * $cart[$product->id];
            // $total_sum += $total_sum_product;
        }



        return view('carts.index', [
            'cart' => $cart,
            'products' => $products,
            // 'total_sum_product' => $total_sum_product,
            // 'total_sum' => $total_sum,
        ]);
    }

    public function checkout(Request $request, Product $product)
    {
        $cart = session('cart', []);
        $products = Product::whereIn('id', array_keys($cart))->get();

        foreach ($products as $product) {
            $total_sum_product = $product->price * $cart[$product->id];
            // $total_sum += $total_sum_product;
        }



        return view('carts.checkout', [
            'cart' => $cart,
            'products' => $products,
            // 'total_sum_product' => $total_sum_product,
            // 'total_sum' => $total_sum,
        ]);
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
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cart $cart)
    {
        //
    }
}
