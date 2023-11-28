@extends('layouts.app')

@section('content')

<div class="container py-5">
    <h1 class="text-center">Ласкаво просимо до вашого профілю {{ $user->name }} {{ $user->last_name }}</h1>

    @include('profile.blocks.nav')

    @foreach ($user->orders as $order)
        <div class="row py-5">
            <div class="col-lg-6 fs-bs">
                <div>
                    <b>
                        Статус замовлення:
                        @if ($order->delivery_status == 'preparing')
                            <span class="badge bg-warning">Готується</span>
                        @elseif ($order->delivery_status == 'delivered')
                            <span class="badge bg-success">Доставлено</span>
                            <i class="bi bi-check-lg text-success fs-4"></i>
                        @elseif ($order->delivery_status == 'returned')
                            <span class="badge bg-info">Повернено</span>
                        @elseif ($order->delivery_status == 'collected')
                            <span class="badge bg-success">Зібрано</span>
                            <i class="bi bi-check-lg text-success fs-4"></i>
                        @endif
                    </b>
                </div>
                <div><b>Номер замовлення: {{ $order->id }}</b></div>
                <div class="sub-color">Дата замовлення: {{ $order->created_at->format('d-m-Y') }}</div>
            </div>
            <div class="col-lg-6 text-end">
                <a href="{{ route('profile.orderShow', ['user' => $user, 'order' => $order]) }}" class="btn send-submit">
                    Більше
                    <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>
        <div class="row">
            @foreach ($order->items as $item)
                <a class="col-lg-2" href="{{ route('profile.orderShow', ['user' => $user, 'order' => $order]) }}">
                    <img src="{{ $item->product->main_img }}" alt="" style="width: 100%">
                </a>
            @endforeach
        </div>
    @endforeach


</div>

@endsection
