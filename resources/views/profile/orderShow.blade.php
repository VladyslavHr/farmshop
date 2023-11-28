@extends('layouts.app')

@section('content')

<div class="container py-5">
    <h1 class="text-center">Ласкаво просимо до вашого профілю {{ $user->name }} {{ $user->last_name }}</h1>
    @include('profile.blocks.nav')

    <h3 class="text-center py-3">Ваше замовлення</h3>

    <div class="row">
        <div class="col-lg-4">
            <div class="fs-bs sub-color">Дата замовлення: <b>{{ $order->created_at->format('d-m-Y') }}</b></div>
            <div class="fs-bs sub-color">Номер замовлення: <b>{{ $order->id }}</b></div>
            <h4 class="py-3">Спосіб доставки</h4>
            @if ($order->self_shipping == 1)
                <div><b>Самовивіз</b></div>
            @else
                <div>{{ $order->name }} {{ $order->last_name}}</div>
                <div>{{ $order->new_post_num }} {{ $order->new_post_adress }}</div>
                <div>{{ $order->new_post_city }} {{ $order->city }}</div>
            @endif

            <h4 class="py-3">Загальна вартість:</h4>
            <div class="fs-bs"><b>{{ number_format($order->total, 0, ',', ' ') }}</b> UAH</div>
        </div>
        <div class="col-lg-8">
            @if ($order->delivery_status == 'preparing')
                <span class="badge fs-5 bg-warning">Готується</span>
            @elseif ($order->delivery_status == 'delivered')
                <span class="badge fs-5 bg-success">Доставлено</span>
                <i class="bi bi-check-lg text-success fs-4"></i>
            @elseif ($order->delivery_status == 'returned')
                <span class="badge fs-5 bg-info">Повернено</span>
            @elseif ($order->delivery_status == 'collected')
                <span class="badge fs-5 bg-success">Зібрано</span>
                <i class="bi bi-check-lg text-success fs-4"></i>
            @endif

            @foreach ($order->items as $item)
            <div class="row py-5">
                <div class="col-lg-2">
                    <img src="{{ $item->product->main_img }}" alt="" style="width: 100%">
                </div>
                <div class="col-lg-10">
                    <div>{{ $item->product_name }}</div>
                    <div class="row">
                        <div class="col-lg-6">
                            <span class="sub-color">Опис</span>
                            <span><b>{{ $item->product->description }}</b></span>
                        </div>
                        {{-- <div class="col-lg-6">
                            <span><b>{{ $item->product->color }}</b></span>
                        </div> --}}
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <span class="sub-color">Ціна:</span>
                            {{--<span><b>{{ $item->product->size }}</b></span> --}}
                            <span><b>{{number_format($item->product_price, 0, ',', ' ') }} UAH</b></span>
                        </div>
                        <div class="col-lg-6">
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </div>
</div>

@endsection
