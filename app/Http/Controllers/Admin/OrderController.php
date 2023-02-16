<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use App\Models\{Order,Product};
use App\Notifications\{OrderClientStoreSend,OrderClientUpdateSend,OrderClientStoreAdmin};
use Mail;

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
                ['val' => '?sortingBy=created_at&sortingDirection=desc', 'lable' => 'Нові'],
                ['val' => '?sortingBy=created_at&sortingDirection=asc', 'lable' => 'Старі'],
                ['val' => '?sortingBy=total&sortingDirection=asc', 'lable' => 'Дешеві'],
                ['val' => '?sortingBy=total&sortingDirection=desc', 'lable' => 'Дорогі'],
                ['val' => '?sortingBy=delivery_status&sortingDirection=asc', 'lable' => 'Статус 🠗'],
                ['val' => '?sortingBy=delivery_status&sortingDirection=desc', 'lable' => 'Статус 🠕'],

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
            'delivery_track' => '',
        ];

        $messages = [
            'delivery_status.required' => 'Fill delivery_status',
        ];

        $data = $request->validate($rules, $messages);

        $saved = $order->update($data);

        if ($order->delivery_status == 'collected' || $order->delivery_status == 'delivered') {
            $order->notify(new OrderClientUpdateSend($order));
        }
        // dd($order);

        return redirect()->route('admin.orders.index');

    }
}
