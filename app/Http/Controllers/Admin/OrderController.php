<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Order,Product};


class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::get();
        return view('admin.orders.index',[
            'orders' => $orders,
        ]);
    }
}
