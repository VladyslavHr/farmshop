<?php

namespace App\Http\Controllers;

use App\Models\{Order,Product};
use App\Http\Requests\{CartStoreRequest};
use Illuminate\Http\Request;
use App\Http\Classes\Cart;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Product $product)
    {

        return view('carts.index', [
            'products' => Cart::getProducts(),
            'total_sum_product' => Cart::getTotalSum(),
        ]);
    }

    public function approve(Product $product)
    {
        $product = Product::where('slug', $slug)->first();
        $cart = Cart::addProduct($product);
        $count = $cart[$product->id];

        return view('carts.approve', [
            'cart' => $cart,
            'count' => $count,
            'product' => $product,
            'total_sum_product' => Cart::getTotalSum(),
            // 'total_sum_product' => $total_sum_product,
            // 'total_sum' => $total_sum,
        ]);
    }


}
