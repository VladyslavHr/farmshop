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
            'total_sum_product_formated' => number_format(Cart::getTotalSum(), 2),
            'totalSumWithoutDiscount' => number_format(Cart::getTotalSumWithoutDiscount(), 2)
        ]);
    }

    public function approve($id)
    {
        $product = Product::where('id', $id)->first();
        $cart = Cart::addProduct($product->id);
        $sudgests = Product::where('id', '!=', $product->id)->where('product_category_id', $product->product_category_id)->inRandomOrder()->limit(6)->get(['id', 'main_img', 'name']);
        // $count = $cart[$product->id];

        return view('carts.approve', [
            'cart' => $cart,
            // 'count' => $count,
            'product' => $product,
            'sudgests' => $sudgests,
            // 'total_sum_product' => Cart::getTotalSum(),
            // 'total_sum_product' => $total_sum_product,
            // 'total_sum' => $total_sum,
        ]);
    }


}
