<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CartStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
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
            'product_id' => 'required|numeric',
            'last_name' => 'required',
            'email' => 'required',
            'phone' => 'required',
        ];
    }

    public function messages() {
        return [
            'required' => 'Поле має бути заповненим.',
        ];
    }
}
