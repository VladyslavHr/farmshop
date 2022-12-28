{{-- @component('mail::message')
# Introduction

The body of your message.

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent --}}


<h2>Повідомлення з контактної форми:</h2>
<br>

<b>Ім'я:</b> {{ $name }}<br>
<b>Імейл:</b> {{ $email }}<br>
<b>Телефон:</b> {{ $phone }}<br>
<b>повідомлення:</b> {{ $text }}<br>
