@extends('layouts.app')

@section('content')

<div class="container py-5">
    <h1 class="text-center">Ласкаво просимо до вашого профілю {{ $user->name }} {{ $user->last_name }}</h1>

    @include('profile.blocks.nav')

    @if (!count($user->orders))
        <h3 class="text-center">У вас ще немає замовлень
            <a class="link-to-shop" href="{{ route('products.index') }}">перейдіть до крамниці</a>
        </h3>
    @else
    <table class="table">
        <thead>
          <tr>
            <th class="text-center" scope="col">Номер замовлення</th>
            <th class="text-center" scope="col">Платіж</th>
            <th class="text-center" scope="col">Усього</th>
            <th class="text-center" scope="col">Кількість продуктів</th>
            <th class="text-center" scope="col">Доставка</th>
            <th class="text-center" scope="col">Статус доставки</th>
            <th class="text-center" scope="col">Дата замовлення</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($user->orders as $order)
                <tr>
                    <th class="text-center" scope="row">
                        <a class="profile-order-link" href="{{ route('profile.orderShow', ['user' => $user, 'order' => $order]) }}">
                            {{ $order->id }}
                        </a>
                    </th>
                    @if ($order->payment_status == 'cash' )
                    <td class="text-center">
                        <span class="badge bg-success">Готівкою</span>
                    </td>
                    @elseif ($order->payment_status == 'paid')
                    <td class="text-center">
                        <span class="badge bg-success">Карткою</span>
                    </td>
                    @elseif ($order->payment_status == 'created')
                    <td class="text-center">
                        <span class="badge bg-secondary">Створено</span>
                    </td>
                    @elseif ($order->payment_status == 'pending')
                    <td class="text-center">
                        <span class="badge bg-warning">Опрацьовується</span>
                    </td>
                    @elseif ($order->payment_status == 'canceled')
                    <td class="text-center">
                        <span class="badge bg-danger">Відмінено</span>
                    </td>
                    @elseif ($order->payment_status == 'refounded')
                    <td class="text-center">
                        <span class="badge bg-info">Повернено</span>
                    </td>
                    @endif
                    <td class="text-center">{{ number_format($order->total, 0, ',', ' ') }} UAH</td>
                    <td class="text-center">{{ $order->product_quantity }}</td>
                    @if ($order->self_shipping == 1)
                    <td class="text-center">Самовивіз</td>
                    @else
                    <td class="text-center">Доставка з Нова Пошта</td>
                    @endif
                    @if ($order->delivery_status == 'preparing')
                    <td class="text-center">
                        <span class="badge bg-warning">Готується</span>
                    </td>
                    @elseif ($order->delivery_status == 'delivered')
                    <td class="text-center">
                        <span class="badge bg-success">Доставлено</span>
                    </td>
                    @elseif ($order->delivery_status == 'returned')
                    <td class="text-center">
                        <span class="badge bg-info">Повернено</span>
                    </td>
                    @elseif ($order->delivery_status == 'collected')
                    <td class="text-center">
                        <span class="badge bg-success">Зібрано</span>
                    </td>
                    @endif
                    {{-- <td class="text-center">{{ $order->delivery_status }}</td> --}}
                    <td class="text-center">{{ $order->created_at->format('d-m-Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @endif

    <h3 class="py-3">Контактна інформація</h3>
    <div class="row">
        <div class="col-lg-3">
            <span class="sub-color">Ім'я</span>
            <div class="main-color"><b>{{ $user->name }}</b></div>
        </div>
        <div class="col-lg-3">
            <span class="sub-color">Прізвище</span>
            <div class="main-color"><b>{{ $user->last_name }}</b></div>
        </div>
        <div class="col-lg-3">
            <span class="sub-color">Електронна пошта</span>
            <div class="main-color"><b>{{ $user->email }}</b></div>
        </div>
        <div class="col-lg-3">
            <span class="sub-color">Телефон</span>
            <div class="main-color"><b>{{ $user->phone }}</b></div>
        </div>
        <div class="col-lg-3">
            <span>Знижка</span>
            <div><b>{{ $user->discount }} %</b></div>
        </div>
        <div class="col-lg-3">
            <span>Самовівіз</span>
            @if ($user->selfship == 0)
            <div><b>НІ</b></div>
            @else
            <div><b>ТАК</b></div>
            @endif
        </div>
    </div>

    <h3 class="py-3">Доставка з Нова Пошта</h3>
    <div class="row">
        <div class="col-lg-3">
            <span class="sub-color">Населенний пункт</span>
            <div class="main-color"><b>{{ $user->firm }}</b></div>
        </div>
        <div class="col-lg-3">
            <span class="sub-color">№ відділення</span>
            <div class="main-color"><b>{{ $user->identification_num }}</b></div>
        </div>
        <div class="col-lg-3">
            <span class="sub-color">Адреса відділення</span>
            <div class="main-color"><b>{{ $user->identification_num }}</b></div>
        </div>
    </div>
</div>

@endsection
