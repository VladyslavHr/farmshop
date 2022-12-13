<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Order,Product};


class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::orderBy('id', 'desc')->paginate(10);
        return view('admin.orders.index',[
            'orders' => $orders,
        ]);
    }

    public function show(Order $order)
    {
        if ($order->payment_status === 'created') {
            $payment_status = "Створено";
        }elseif($order->payment_status === 'pending') {
            $payment_status = "Опрацьовується";
        }elseif($order->payment_status === 'paid') {
            $payment_status = 'Сплачено';
        }elseif($order->payment_status === 'canceled') {
            $payment_status = 'Відмінено';
        }elseif ($order->payment_status === 'refounded') {
            $payment_status = 'Повернуто';

        }

        return view('admin.orders.show',[
            'order' => $order,
            'payment_status' => $payment_status,
        ]);
    }

    public function update(Request $requsets, Order $order)
    {
        $rules = [
            'delivery_status' => 'required',
        ];

        $messages = [
            'delivery_status.required' => 'Fill delivery_status',
        ];

        $data = $request->validate($rules, $messages);

        $saved = $order->update($data);
    }
}
