<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Order,Product};

class DashboardController extends Controller
{
    public function index()
    {
        // $orders = Order::where('payment_status', 'paid')->orWhere('payment_status', 'cash')
        // ->where('delivery_status', 'preparing')->orWhere()->orderBy('created_at', 'desc')->get();
        $orders = Order::where(function ($query) {
            $query->where('payment_status', 'paid')
                ->orWhere('payment_status', 'cash');
        })
        ->where('delivery_status', 'preparing')
        ->orderBy('created_at', 'desc')
        ->get();

        return view('admin.dashboard.index',[
            'orders' => $orders,
        ]);
    }
}
