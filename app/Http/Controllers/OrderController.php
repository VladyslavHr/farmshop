<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function store()
    {
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
            'name.required' => 'Напишіть будь ласка назву.',
            'product_category_id' => 'Виберіть будь ласка категорію товару',
            'price' => 'Напишіть будь ласка ціну товару',
            'price_type' => 'Напишіть будь ласка вид ціни',
            'main_img' => 'Картинка має бути у форматі (jpg,png,webp).',
            'logo' => 'Логотип має бути у форматі (jpg,png,webp).',
            'seo_title.required' => 'Напишіть будь ласка заголовок для SEO .',
            'seo_keywords.required' => 'Напишіть будь ласка ключові слова для SEO.',
            'seo_description.required' => 'Напишіть будь ласка опис для SEO.',
        ];

        $data = $request->validate($rules, $message);


        Order::create($data);

        return view('carts.thanks');
    }
}
