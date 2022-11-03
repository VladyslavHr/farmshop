@extends('layouts.app')

@section('page-title', 'Кошик')

@section('content')

<div class="container py-3">

    <div class="cart-header">
        <div class="cart-header-title">
            <h1 class="cart-title py-2">Кошик</h1>
        </div>
    @if (count($products))

        <div class="cart-header-btn-clean">
            <button onclick="clearCart(this)" class="btn btn-danger" name="{{ route('clearCart') }}">Видалити все</button>
        </div>
    @endif
    </div>
    @if (count($products))

    <div class="full-cart">


        <div class="row mt-3 cart-product-titles">
            <div class="col-lg-1"></div>
            <div class="col-lg-1"></div>
            <div class="col-lg-5">Товар</div>
            <div class="col-lg-1 text-center">Ціна</div>
            <div class="col-lg-2 text-center">Кількість</div>
            <div class="col-lg-1 text-center">Сума</div>
        </div>
        @foreach ($products as $product)
        <div class="row mt-1 cart-product-item product-{{ $product->id }}">
            <form class="col-lg-1" action="{{ route('removeFromCart', $product) }}" method="POST"
                onsubmit="remove_button_cart(this, event)">
                @csrf
                <button class="cart-item-remove-btn" type="submit">
                    {{-- <i class="bi bi-x-lg"></i> --}}
                    X
                </button>
            </form>
            <div class="col-lg-1 cart-product-img">
                <img src="{{ $product->main_img }}" alt="{{ $product->name }}">
            </div>
            <div class="col-lg-5 cart-product-name">
                {{ $product->name }}
            </div>
            <div class="col-lg-1">
                {{ $product->price }} ₴
            </div>
            <div class="col-lg-2 text-center">
                <button class="cart-quantity-control" onclick="cart_item_minus(this)"><i class="bi bi-dash-circle"></i></button>
                <input  type="number"
                    class="cart-product-show-input-quantity js-cart-item-quantity"
                    value="{{ $product->cart_quantity }}"
                    max="{{ $product->quantity }}"
                    data-productid="{{ $product->id }}"
                    oninput="cart_item_quantity_change(this)">
                <button class="cart-quantity-control" onclick="cart_item_plus(this)"><i class="bi bi-plus-circle"></i></button>
            </div>
            <div class="col-lg-1 ">
                <span class="js-cart-product-sum">
                    {{-- {{ number_format($product->sum, 2) }} --}}
                    {{ $product->sum_formated }}
                </span>
                 ₴
            </div>
        </div>
        @endforeach

        <div class="row mt-1 cart-product-sum">
            <div class="col-lg-8">
            </div>
            <div class="col-lg-1">
                <strong>
                    Разом
                </strong>
            </div>
            <div class="col-lg-1">
                <span class="js-cart-total-sum">
                    {{  $total_sum_product_formated }}
                </span>
                ₴
                {{-- {{ Cart::getTotalSum() }} ₴ --}}
            </div>
            <div class="col-lg-2">
                <a href="{{ route('orders.index') }}" class="btn btn-warning">Оформити замовлення</a>
            </div>
        </div>

    </div>
    @endif
        <div class="empty-cart @if (count($products)) hidden @endif">
            Наразі ваш кошик порожний,
            <a href="{{ route('products.index') }}">
                перейти до крамниці
            </a>
        </div>
</div>



@endsection
