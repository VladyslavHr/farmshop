<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Contact};
use Mail;


class ContactController extends Controller
{
    public function index()
    {
        return view('contacts.index',[

        ]);
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'text' => 'required',
            'g-recaptcha-response' => 'required|recaptchav3:contact,0.5',
		];
        $message = [
            'name.required' => "Заповніть будь ласка своє Ім'я.",
            'email.required' => 'Заповніть будь ласка свій Імеіл.',
            'text.required' => 'Напишіть будь ласка справу.',
            'phone.required' => 'Заповніть будь ласка свій моб. телефон.',
            'g-recaptcha-response.recaptchav3' => 'Capture error'
        ];

        $data = $request->validate($rules, $message);

        Contact::create($data);

        Mail::send('emails.contacts.income', [
                'email' => $request->email,
                'name' => $request->name,
                'text' => $request->text,
                'phone' => $request->phone,
            ],
            function ($message) use ($request) {
            $message->from(env('MAIL_USERNAME', 'info@wildfarm.com.ua'), env('APP_NAME'));
            $message->to('info@wildfarm.com.ua', 'Wildfarm.com.ua');
            $message->bcc('bestsecretvlad@gmail.com', 'Wildfarm.com.ua');
            $message->replyTo($request->email, $request->name);
            $message->subject('Повідомлення з контактної форми');
        });

        return redirect()->route('home.index');
    }

    public function payAndDelivery()
    {
        return view('contacts.payAndDelivery');
    }

    public function retunrRules()
    {
        return view('contacts.retunrRules');
    }
}
