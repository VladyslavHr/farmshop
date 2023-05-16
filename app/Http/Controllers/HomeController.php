<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{ProductType};


class HomeController extends Controller
{
    public function index()
    {
        $productsType = ProductType::get();
        return view('home.index',[
            'productsType' => $productsType,
        ]);
    }

    public function goPayNotification(Request $request)
    {
        $data = [
            'method' => $request->method(),
            'data' => $request->all(),
        ];

        dump($data);

        file_put_contents(public_path('gopay-notification.json'), json_encode($data, 128));

    }
}
