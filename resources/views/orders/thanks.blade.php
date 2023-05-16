@extends('layouts.app')

@section('page-title', 'thanks')

@section('content')

<div class="container py-5">

    {{-- <h2>{{ $message }}</h2> --}}
    @if ($isSuccess)
    <div class="text-center py-5">
        <h1>Д'якуємо за ваше замовлення</h1>
        <h3>Номер вашого замовлення <b>{{ $order->id }}</b></h3>
        <p class="fs-5">Підтвердження вашого замовлення прийде на вказану вами елктронну пошту.</p>
        @if ($order->self_shipping == 1)
            <p class="fs-5">Як тільки ваше замовлення буде зібране, на електронну пошту отримаєте підтвердження.</p>
            <p class="fs-5">Замовлення можете забрати за адресою <a class="thnaks-link-style" href="https://goo.gl/maps/L6uoThWfC2Rr35By6">Вул. Гагаріна 18, с. Соколово, Новомосковський район, Дніпропетровська область</a></p>
        @else
            <p class="fs-5">Як тільки ваше замовлення буде відправлене, на електронну пошту отримаєте підтвердження з номером відпралення.</p>
        @endif

        <h5><a class="thnaks-link-style" href="{{ route('home.index') }}">На головну сторінку</a></h5>
    </div>
    @else
    <div class="text-center py-5">
        <h1>Нажаль сталася помилка</h1>
        <h3>Будь ласка спробуйте зробити замовлення ще раз <a class="thnaks-link-style" href="{{ route('products.index') }}">перейти до крамниці</a></h3>
    </div>
    @endif

</div>

@endsection
