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
            'phone' => 'required',
            'new_post_num' => 'required_without_all:post_num, self_shipping',
            'new_post_adress' => '',
            'post_num' => 'required_without_all:self_shipping, new_post_num',
            'post_adress' => '',
            'self_shipping' => 'required_without_all:post_num, new_post_num',
            'order_note' => '',

		];
    }

    public function messages()
    {
        return [
            'name.required' => 'Напишіть будь ласка Імя.',
            'last_name.required' => 'Напишіть будь ласка Прізвище.',
            'email.required' => 'Напишіть будь ласка Мейл.',
            'phone.required' => 'Напишіть будь ласка телефон.',
            'self_shipping.required_without_all' => 'Please choose delivery1',
            'post_num.required_without_all' => 'Please choose delivery2',
            'new_post_num.required_without_all' => 'Please choose delivery3',

        ];
    }
}
