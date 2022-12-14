@extends('admin.layouts.adminapp')

@section('page-title', 'Замовлення')

@section('content')

<div class="container py-2">
    <h4 class="pt-3 pb-1">
        <i class="bi bi-file-person"></i>
        Контакт покупця:
    </h4>
    <div class="row border-devider">
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

    <h4 class="pt-3 pb-1">
        <i class="bi bi-cash-coin"></i>
        Платіжна інформація:
    </h4>
    <div class="row border-devider">
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

    <h4 class="pt-3 pb-1">
        <i class="bi bi-truck"></i>
        Адреса доставки:
    </h4>
    <div class="row border-devider">
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

    <h4 class="pt-3 pb-1">
        <i class="bi bi-chat-left-text"></i>
        Коментар до замовлення:
    </h4>
    <div class="row border-devider">
        <div class="col-lg-12">
            {{ $order->order_note }}
        </div>
    </div>

    <h4 class="pt-3 pb-1">
        <i class="bi bi-box-seam"></i>
        Продукти:
    </h4>
    @foreach ($order->orderItem as $item)
        <div class="row border-devider">
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

    <h4 class="pt-3 pb-1">
        Доставка:
    </h4>
    <div class="row border-devider">
        <div class="col-lg-6">
            <strong>
                Статус платежа:
            </strong>
            {{ $payment_status }}
        </div>
        <form action="{{ route('admin.orders.update', $order) }}" class="col-lg-6" method="POST">
            @csrf
            <div class="input-group">
                <span class="me-3">
                    <strong>
                        Статус доставки:
                    </strong>
                </span>
                <select class="form-select" name="delivery_status" id="">
                    <option value="preparing" {{ $order->delivery_status == 'preparing' ? 'selected' : '' }}>Збирається</option>
                    <option value="delivered" {{ $order->delivery_status == 'delivered' ? 'selected' : '' }}>Відправлено</option>
                    <option value="returned" {{ $order->delivery_status == 'returned' ? 'selected' : '' }}>Повернуто</option>
                </select>
                <button class="btn btn-outline-secondary" type="submit">Змінити</button>
            </div>
        </form>
    </div>

    <div class="pt-3 pb-1">
        <button class="btn btn-danger"
            onsubmit="if(!confirm('Повернути кошти?')) return false">
            Повернути кошти
        </button>
    </div>


</div>


@endsection
