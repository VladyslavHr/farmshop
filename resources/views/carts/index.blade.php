@extends('layouts.app')

@section('page-title', 'Кошик')

@section('content')

<div class="container py-3">
    <h1 class="cart-title py-2">Кошик</h1>
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
            <input type="number" class="cart-product-show-input-quantity" value="{{ $cart[$product->id] }}">
        </div>
        <div class="col-lg-1">
            {{-- {{ $total_sum_product }} ₴ --}}
            {{$product->price * $cart[$product->id]}} ₴
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
</div>
<div class="row">
    <div class="col-lg-6">
        Разом: 10000 ₴
    </div>
    <div class="col-lg-6">
        <a href="{{ route('carts.checkout') }}" class="btn btn-warning">Оформити замовлення</a>
    </div>
</div>


@endsection
