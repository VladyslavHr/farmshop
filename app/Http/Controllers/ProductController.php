<?php

namespace App\Http\Controllers;

use App\Models\{Product,ProductCategory,PromoCode};
use Illuminate\Http\Request;
use Cart;
// use App\Http\Classes\Cart;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $products = Product::get();
        $cart = session('cart', []);
        // $cart_products = Product::whereIn('id', array_keys($cart))->get();

        // $categories = ProductCategory::get();

        return view('products.index', [
            // 'products' => $products,
            'cart' => $cart,
            // 'cart_products' => $cart_products,
            // 'categories' => $categories,
            'user' => auth()->user(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {

        $product = Product::where('slug', $slug)->first();
        $cart = session('cart', []);
        $cart_products = Product::whereIn('id', array_keys($cart))->get();
        $interest_category = ProductCategory::where('id', $product->product_category_id)->get();

        // dd($interests, 2 );
        // if ( $product->status === 'in_stock') {
        //     'В наявності';
        // } elseif ($product->status === 'out_of_stock') {
        //     'Немає в наявності';
        // } elseif ($product->status === 'for_order') {
        //     'Під замовлення';
        // }



        return view('products.show',[
            'product' => $product,
            'product_quantity' => Cart::getProducts(),
            'cart' => $cart,
            'interest_category' => $interest_category,
            // 'cart_products' => $cart_products,
            'user' => auth()->user(),
        ]);
    }

    // public function showCartAdd(Request $request, $product)
    // {
    //     $product = Product::where('slug', $slug)->first();
    //     $cart = Cart::addProduct($product);
    //     $count = $cart[$product->id];

    //     return view('carts.approve', [
    //         'product' => $product,
    //     ]);

    // }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }

    // public function addToCart($product_id)
    // {
    //     auth()->user()->cart_add($product_id);
    // 	return back()->with('status', 'Товар добавлен в корзину.');
    // }

    public function addToCart(Request $request, $productId)
    {
        $cart = Cart::addProduct($productId);

        return [
            'status' => 'ok',
            'added' => true,
            'count' => $cart[$productId],
            'cart_total_count' => Cart::getTotalCount(),
        ];

    }


    public function removeFromCart(Request $request, $productId)
    {
        Cart::removeProduct($productId);

        return [
            'status' => 'ok',
            'cart_total_count' => Cart::getTotalCount(),
            'cart_total_sum' =>  number_format(Cart::getTotalSum(), 2),
        ];
    }


    public function clearCart()
    {
        Cart::clear();

        return [
            'status' => 'ok',
        ];
    }

    public function updateCart(Request $request)
    {

        if (isset($request->promo_code)) {
            Cart::getPromoCodeToCart($request->promo_code);
        }

        Cart::updateProduct($request->productId, $request->quantity);

        Cart::getproductSum($request->productId);

        return [
            'status' => 'ok',
            // 'promo_code' => 'ok',
            'sum' => number_format(Cart::getproductSum($request->productId), 2),
            'cart_total_sum' => number_format(Cart::getTotalSum(), 2),
            'totalSumWithoutDiscount' => number_format(Cart::getTotalSumWithoutDiscount(), 2),
        ];
    }
}
