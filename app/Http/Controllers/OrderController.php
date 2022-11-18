<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Order,Product,OrderItem};
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
        $product_count = Cart::getTotalCount();

        $rules = [
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
        $data['product_quantity'] =  $product_count;
        // $data['user_id'] = auth()->user()->id;

        $order = Order::create($data);

        $products = Cart::getProducts();

        foreach ($products as $product) {
            $order_item['order_id'] = $order->id;
            $order_item['product_id'] = $product->id;
            $order_item['product_name'] = $product->name;
            $order_item['product_price'] = $product->price;
            $order_item['product_old_price'] = $product->old_price;
            $order_item['product_count'] = $product->cart_quantity;


            $ordered = OrderItem::create($order_item);


            // dd($ordered->product_count);
            // $rest_product = Product::find('id', $ordered->product_id);
            // dd($rest_product);
            // $rest_product->quantity - $ordered->product_count;
            // $rest_product_count = $rest_product- $product->cart_quantity;
            // dd( $rest_product_count);
        }

        // foreach ($ordered as $item) {
        //     $rest_products = Product::whereIn('id', $item['product_id']);
        // dd( $rest_products)->toArray();

        // }

        // $rest_products = Product::all();


        // $rest_products = Product::find('id', $ordered->product_id);
        // $ordered_products = Orderitem::all();

        // $count_products =



        session()->forget('cart');

        return redirect()->route('orders.thanks');
    }

    public function thanks()
    {
        return view('orders.thanks');
    }
}
