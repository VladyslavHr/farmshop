@extends('admin.layouts.adminapp')

@section('page-title', 'Замовлення')

@section('content')

<div class="container py-2">
    <h4 class="py-3">
        <i class="bi bi-file-person"></i>
        Контакт покупця:
    </h4>
    <div class="row">
        <div class="col-lg-2">
            <strong>
                Номер замовлення:
            </strong>
            {{ $order->id }}
        </div>
        <div class="col-lg-2">
            <strong>
                Ім'я:
            </strong>
            {{ $order->name }}
        </div>
        <div class="col-lg-2">
            <strong>
                Прізвище:
            </strong>
            {{ $order->last_name }}
        </div>
        <div class="col-lg-3">
            <strong>
                Емеіл:
            </strong>
            {{ $order->email }}
        </div>
        <div class="col-lg-2">
            <strong>
                Телефон:
            </strong>
            {{ $order->phone }}
        </div>
    </div>

    <h4 class="py-3">
        <i class="bi bi-cash-coin"></i>
        Платіжна інформація:
    </h4>
    <div class="row">
        <div class="col-lg-3">
            <strong>
                Платіжний метод:
            </strong>

        </div>
        <div class="col-lg-3">
            <strong>
                Загальна сума:
            </strong>
            {{ $order->total }} UAH
        </div>
        <div class="col-lg-3">
            <strong>
                Загальна к-ть один. товару:
            </strong>
            {{ $order->product_quantity }}
        </div>
    </div>

    <h4 class="py-3">
        <i class="bi bi-truck"></i>
        Адреса доставки:
    </h4>
    <div class="row">
        @if ($order->post_num && $order->post_adress != null)
            <div class="col-lg-6">
                <strong>
                    Номер поштового відділення:
                </strong>
                {{ $order->post_num }}
            </div>
            <div class="col-lg-6">
                <strong>
                    Адреса поштового відділення:
                </strong>
                {{ $order->post_adress }}
            </div>
        @endif
        @if ($order->new_post_num && $order->new_post_adress != null)
        <div class="col-lg-6">
            <strong>
                Номер відділення Нової Пошти:
            </strong>
            {{ $order->new_post_num }}
        </div>
        <div class="col-lg-6">
            <strong>
                Адреса відділення Нової пошти:
            </strong>
            {{ $order->new_post_adress }}
        </div>
        @endif
        @if ($order->self_shipping == 1)
            <div class="col-lg-6">
                <strong>
                    Самовивіз
                </strong>
            </div>
        @endif
    </div>

    <h4 class="py-3">
        <i class="bi bi-chat-left-text"></i>
        Коментар до замовлення:
    </h4>
    <div class="row">
        <div class="col-lg-12">
            {{ $order->order_note }}
        </div>
    </div>

    <h4 class="py-3">
        <i class="bi bi-box-seam"></i>
        Продукти :
    </h4>
    @foreach ($order->orderItem as $item)
        <div class="row">
            <div class="col-lg-3 py-1">
                <strong>
                    Назва:
                </strong>
                {{ $item->product_name }}
            </div>
            <div class="col-lg-3 py-1">
                <strong>
                    Ціна до знижки:
                </strong>
                {{ $item->product_old_price }} UAH
            </div>
            <div class="col-lg-3 py-1">
                <strong>
                    Ціна:
                </strong>
                {{ $item->product_price }} UAH
            </div>
            <div class="col-lg-3 py-1">
                <strong>
                    Кількість:
                </strong>
                {{ $item->product_count }}
            </div>
        </div>
    @endforeach

    <div class="row">
        <div class="col-lg-4">
            <strong>
                Статус платежа:
            </strong>
            {{ $payment_status }}
        </div>
        <form action="{{ route('admin.orders.update') }}" class="col-lg-4">



        </form>
    </div>


</div>


@endsection
