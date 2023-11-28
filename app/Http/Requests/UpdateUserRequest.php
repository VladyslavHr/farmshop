<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateUserRequest extends FormRequest
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
        $userId = Auth::id(); // Получаем ID аутентифицированного пользователя

        $rules = [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $userId,
            'phone' => 'regex:/^\+380\d{9}$/',
        ];

        return $rules;
    }

    public function messages()
    {
        return [
            'name.required' => "Будь ласка напишіть Ім'я.",
            'last_name.required' => 'Будь ласка напишіть Прізвище.',
            'email.required' => 'Будь ласка напишіть Електронну пошту.',
            'phone.regex' => 'Будь ласка введіть валідний український номер телефону у форматі +380XXXXXXXXX.',
        ];
    }
}
