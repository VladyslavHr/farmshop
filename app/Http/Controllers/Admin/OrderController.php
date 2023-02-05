<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Order,Product};


class OrderController extends Controller
{
    public function index(Request $request)
    {
        $sortingBy = $request->sortingBy ?? 'id';
        $sortingDirection = $request->sortingDirection ?? 'desc';

        $orders = Order::orderBy($sortingBy, $sortingDirection)->paginate(10);

        // dd($request->all());

        return view('admin.orders.index',[
            'orders' => $orders,
            'sortingParams' => '?sortingBy='.request('sortingBy').'&sortingDirection='.request('sortingDirection'),
            'sortingOptions' => [
                ['val' => '?sortingBy=total&sortingDirection=asc', 'lable' => 'дешевые'],
                ['val' => '?sortingBy=total&sortingDirection=desc', 'lable' => 'дорошие'],
                ['val' => '?sortingBy=delivery_status&sortingDirection=asc', 'lable' => 'статус 🠗'],
                ['val' => '?sortingBy=delivery_status&sortingDirection=desc', 'lable' => 'статус 🠕'],
                ['val' => '?sortingBy=created_at&sortingDirection=asc', 'lable' => 'старые'],
                ['val' => '?sortingBy=created_at&sortingDirection=desc', 'lable' => 'новые'],
            ]
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

    public function update(Request $request, Order $order)
    {
        $rules = [
            'delivery_status' => 'required',
        ];

        $messages = [
            'delivery_status.required' => 'Fill delivery_status',
        ];

        $data = $request->validate($rules, $messages);

        $saved = $order->update($data);

        return redirect()->back();

    }
}
