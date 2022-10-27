<?php

namespace  App\Http\Classes;

use Illuminate\Support\ServiceProvider;


class Cart extends ServiceProvider
{

    // private static $cartArr;

    public static function addProduct($productId)
    {
        $cart = session('cart', []);

        if ($cart) {
			if (isset($cart[$productId])) {
				$cart[$productId]++;
			}else{
				$cart[$productId] = 1;
			}
		}else{
			$cart = [$productId => 1];
		}


        session(['cart' => $cart]);

        // self::$cartArr = $cart;

        return $cart;

    }

    public static function removeProduct($productId)
    {
        $cart_arr = session('cart', []);

        unset($cart_arr[$productId]);

        session(['cart' => $cart_arr]);

        return $cart_arr;

    }

    public static function clear()
    {
        session()->forget('cart');
    }

    public static function getTotalCount()
    {
        $cart = session('cart', []);

        $total = 0;

        foreach ($cart as $count) {
            $total += $count;
        }

        return $total;
    }






}
