<?php

namespace App\Http\Controllers;

use App\Models\{Product,ProductCategory};
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::get();
        $cart = session('cart', []);
        $cart_products = Product::whereIn('id', array_keys($cart))->get();

        $categories = ProductCategory::get();

        return view('products.index', [
            'products' => $products,
            'cart' => $cart,
            'cart_products' => $cart_products,
            'categories' => $categories,
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

        // if ( $product->status === 'in_stock') {
        //     'В наявності';
        // } elseif ($product->status === 'out_of_stock') {
        //     'Немає в наявності';
        // } elseif ($product->status === 'for_order') {
        //     'Під замовлення';
        // }



        return view('products.show',[
            'product' => $product,
        ]);
    }

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

    public function addToCart(Request $request, $product_id)
    {
        // session()->push(['compare' => [$id]]);

        // $request->session()->put('key', 'value');
        $cart = session('cart', []);

        if ($cart) {
			if (isset($cart[$product_id])) {
				$cart[$product_id]++;
			}else{
				$cart[$product_id] = 1;
			}
		}else{
			$cart = [$product_id => 1];
		}


        session(['cart' => $cart]);

        return [
            'status' => 'ok',
            'added' => true,
        ];

        // return redirect()->back();
    }


    public function removeFromCart(Request $request, $product_id)
    {

        if ($request->has('remove_all_cart')) {
            session()->forget('cart');
            return[
                'status' => 'ok',
            ];
        }

        $cart_arr = session('cart', []);

        unset($cart_arr[$product_id]);

        session(['cart' => $cart_arr]);


        // $value = $request->session()->pull('compare', $caravan);

        return [
            'status' => 'ok',
            'added' => false,
        ];
    }
}
