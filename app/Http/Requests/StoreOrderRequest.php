<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'phone' => 'regex:/^\+380\d{9}$/',
            'new_post_num' => 'required_without_all:self_shipping',
            'new_post_adress' => 'required_without_all:self_shipping',
            'new_post_city' => 'required_without_all:self_shipping',
            // 'post_num' => 'required_without_all:self_shipping,new_post_num',
            // 'post_adress' => '',
            'self_shipping' => 'required_without_all:new_post_num',
            'order_note' => '',
            'payment_method' => ['required'],
		];
    }

    public function messages()
    {
        return [
            'name.required' => 'Напишіть будь ласка Імя.',
            'last_name.required' => 'Напишіть будь ласка Прізвище.',
            'email.required' => 'Напишіть будь ласка Мейл.',
            'phone.regex' => 'Будь ласка введіть валідний український номер телефону у форматі +380XXXXXXXXX.',
            'self_shipping.required_without_all' => 'Будь ласка виберіть достаку',
            // 'post_num.required_without_all' => 'Please choose delivery2',
            'new_post_num.required_without_all' => 'Будь ласка напишіть номер відділення',
            'new_post_city.required_without_all' => 'Будь ласка напишіть місто відділення',
            'new_post_adress.required_without_all' => 'Будь ласка напишіть адресу відділення',
        ];
    }
}
