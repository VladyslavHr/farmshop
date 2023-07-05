@extends('layouts.app')

@section('page-title', 'Кошик')

@section('content')

<div class="container py-5">
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
        <div class="full-cart-small-screen">
            @foreach ($products as $product)
                <div id="cart_product_item_small" class="cart-product-item-small product-{{ $product->id }}">
                    <div class="row text-center pt-3">
                        <div class="col-sm-12 text-center cart-wrap-img">
                            <a href="{{ route('products.show', $product->slug) }}">
                                <img class="cart-product-image" src="{{ $product->main_img }}" alt="{{ $product->name }}">
                            </a>
                            <form class="cart-item-delete-small" action="{{ route('removeFromCart', $product) }}" method="POST"
                            onsubmit="remove_cart_item(this, event)">
                            @csrf
                            <button class="cart-item-remove-btn" type="submit">
                                X
                            </button>
                        </form>
                        </div>
                    </div>
                    <div class="row text-center pt-3 fs-5">
                        <div class="col-sm-6">Товар</div>
                        <div class="col-sm-6">
                            <a href="{{ route('products.show', $product->slug) }}" class="cart-product-name-link">
                                {{ $product->name }}
                            </a>
                        </div>
                    </div>
                    <div class="row text-center pt-3 fs-5">
                        <div class="col-sm-6">Ціна</div>
                        <div class="col-sm-6">{{ $product->price }} ₴</div>
                    </div>
                    <div class="row text-center pt-3 fs-5">
                        <div class="col-sm-6">Кількість</div>
                        <div class="col-sm-6">
                            <button class="cart-quantity-control" onclick="cart_item_minus(this)"><i class="bi bi-dash-circle"></i></button>
                            <input  type="number"
                                class="cart-product-show-input-quantity js-cart-item-quantity"
                                value="{{ $product->cart_quantity }}"
                                max="{{ $product->quantity }}"
                                data-productid="{{ $product->id }}"
                                oninput="cart_item_quantity_change(this)">
                            <button class="cart-quantity-control" onclick="cart_item_plus(this)"><i class="bi bi-plus-circle"></i></button>
                        </div>
                    </div>
                    <div class="row text-center pt-3 fs-5">
                        <div class="col-sm-6">Сума</div>
                        <div class="col-sm-6">
                            <span class="js-cart-product-sum">
                                {{ $product->sum_formated }}
                            </span>
                            ₴
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="row text-center pt-3 fs-5">
                <div class="col-sm-6">
                    <strong>
                        Разом
                    </strong>
                </div>
                <div class="col-sm-6">
                    <span class="js-cart-total-sum">
                        {{  $total_sum_product_formated }}
                    </span>
                    ₴
                </div>
            </div>
            <div class="row text-center pt-5 fs-5">
                <div class="col-sm-12">
                    <a href="{{ route('orders.index') }}" class="btn send-submit">Оформити замовлення</a>
                </div>
            </div>
        </div>

        <div class="full-cart">
            <div class="row mt-3 cart-product-titles">
                <div class="col-lg-1"></div>
                <div class="col-lg-1"></div>
                <div class="col-lg-4">Товар</div>
                <div class="col-lg-1 text-center">Ціна</div>
                <div class="col-lg-3 text-center">Кількість</div>
                <div class="col-lg-1 text-center">Сума</div>
            </div>
            @foreach ($products as $product)
            <div id="cart_product_item_full" class="row mt-1 cart-product-item product-{{ $product->id }}">
                <form class="col-lg-1" action="{{ route('removeFromCart', $product) }}" method="POST"
                    onsubmit="remove_cart_item(this, event)">
                    @csrf
                    <button class="cart-item-remove-btn" type="submit">
                        {{-- <i class="bi bi-x-lg"></i> --}}
                        X
                    </button>
                </form>
                <div class="col-lg-1 cart-product-img">
                    <a href="{{ route('products.show', $product->slug) }}">
                        <img src="{{ $product->main_img }}" alt="{{ $product->name }}">
                    </a>
                </div>
                <div class="col-lg-4 cart-product-name">
                    <a href="{{ route('products.show', $product->slug) }}" class="cart-product-name-link">
                        {{ $product->name }}
                    </a>
                </div>
                <div class="col-lg-1">
                    {{ $product->price }} ₴
                </div>
                <div class="col-lg-3 text-center">
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

            <div class="row mt-1 cart-product-sum align-items-center">
                <div class="col-lg-3">
                </div>
                <div class="col-lg-1">
                    <strong>
                        Промо код
                    </strong>
                </div>
                <div class="col-lg-2">
                    <input name="promo_code" type="text" class="input-checkout" id="promo_code_input"
                        {{-- value="{{ $promoCode }}" --}}
                        data-productid="{{ $product->id }}"
                        oninput="cart_promo_code(this)">
                </div>
                <div class="col-lg-1">
                    <span id="discount_value">
                        Знижка ...
                    </span>
                </div>
                <div class="col-lg-1">
                    <strong>
                        Разом
                    </strong>
                </div>
                <div class="col-lg-1">
                    <span class="js-cart-total-sum" id="">
                        {{  $total_sum_product_formated }}
                        {{-- <span>

                        </span> --}}
                    </span>
                    ₴
                </div>
                {{-- <div class="col-lg-1">
                    <span id="total_sum_without_discount">
                        {{ $totalSumWithoutDiscount }}

                    </span>

                </div> --}}
                <div class="col-lg-2">
                    <a href="{{ route('orders.index') }}" class="btn send-submit">Оформити замовлення</a>
                </div>
            </div>
        </div>
    @endif
        <div class="empty-cart @if (count($products)) hidden @endif py-5">
            Наразі ваш кошик порожний,
            <a href="{{ route('products.index') }}">
                перейти до крамниці
            </a>
        </div>
</div>



@endsection
