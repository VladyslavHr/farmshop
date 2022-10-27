@extends('layouts.app')

@section('page-title', 'Кошик')

@section('content')

<div class="container py-3">
    <h1 class="cart-title py-2">Кошик

        <button onclick="clearCart(this)" class="btn btn-danger" name="{{ route('clearCart') }}">Cleare cart</button>
    </h1>
    <div class="row mt-3 cart-product-titles">
        <div class="col-lg-1"></div>
        <div class="col-lg-1"></div>
        <div class="col-lg-5 "> Товар </div>
        <div class="col-lg-1 text-center"> Ціна </div>
        <div class="col-lg-2 text-center"> Кількість </div>
        <div class="col-lg-1 text-center"> Сума </div>
    </div>

    @foreach ($products as $product)
    <div class="row mt-1 cart-product-item">
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
            <input id="cart_quantity" type="number" class="cart-product-show-input-quantity" value="{{ $cart[$product->id] }}">
        </div>
        <div class="col-lg-1">
            {{ $product_sum }} ₴
        </div>
    </div>




    {{-- <div class="cart-product-item">
        <form class="cart-product-item-delete" action="{{ route('removeFromCart', $product) }}" method="POST"
            onsubmit="remove_button_cart(this, event)">
            @csrf
            <button class="vehicle-item-form-delete-item-button" type="submit">
                <i class="bi bi-x-lg"></i>
            </button>
        </form>
        <div class="cart-product-img">
            <img src="{{ $product->main_img }}" alt="">
        </div>
        <div class="cart-product-name">
            {{ $product->name }}
        </div>
        <div class="cart-product-price">
            {{ $product->price }} ₴
        </div>
        <div class="cart-product-quntity">
            <input type="number" class="cart-product-show-input-quantity" value="{{ count($cart) }}">
        </div>
        <div class="cart-product-sum">
            {{ $product->price * count($cart) }}
        </div>
    </div> --}}
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
            10000 ₴
        </div>
        <div class="col-lg-2">
            <a href="{{ route('carts.checkout') }}" class="btn btn-warning">Оформити замовлення</a>
        </div>
    </div>
</div>



@endsection
