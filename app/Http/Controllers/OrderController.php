<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Order,Product};
use App\Http\Requests\{CartStoreRequest};
use App\Http\Classes\Cart;


class OrderController extends Controller
{
    public function index()
    {
        return view('orders.index', [
            // 'cart' => $cart,
            // 'products' => $products,
            'products' => Cart::getProducts(),
            'total_sum_product' => Cart::getTotalSum(),
            // 'total_sum_product' => $total_sum_product,
            // 'total_sum' => $total_sum,
        ]);
    }


    public function store(Request $request, Product $product)
    {
        $total_sum_product = Cart::getTotalSum();

        $rules = [
            'product_id' => 'required',
            'price_per_one' => 'required',
            'total' => 'required',
            'product_quantity' => 'required',
            'name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'new_post_num' => '',
            'new_post_adress' => '',
            'post_num' => '',
            'post_adress' => '',
            'self_shipping' => '',
            'order_note' => '',

		];

        $message =         [
            'name.required' => 'Напишіть будь ласка Імя.',
            'last_name.required' => 'Напишіть будь ласка Прізвище.',
            'email.required' => 'Напишіть будь ласка Мейл.',
            'phone.required' => 'Напишіть будь ласка телефон.',
        ];

        $data = $request->validate($rules, $message);
        $data['total'] =  $total_sum_product;
        // $data['user_id'] = auth()->user()->id;

        Order::create($data);

        $products = Cart::getProducts();

        foreach ($products as $product) {
            OrderItem::create(['order_id', 'product_id', 'nameprod', 'product_price',  'product_count']);
        }



        session()->forget('cart');

        return redirect()->route('orders.thanks');
    }

    public function thanks()
    {
        return view('orders.thanks');
    }
}
