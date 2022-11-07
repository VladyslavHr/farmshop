@extends('layouts.app')

@section('page-title', 'Оформлення замовлення')

@section('content')

<div class="container">
    <div class="row align-items-center py-5">
        <div class="col-lg-2">
            <img style="width: 100%" src="{{ $product->main_img }}" alt="">
        </div>
        <div class="col-lg-3">
            <div class="approve-product-name">
                {{ $product->name }}
            </div>
            <span class="approve-check-message">
                <i class="bi bi-check-lg"></i>
                <span>
                    Товар успішно додано до кошика
                </span>
            </span>

        </div>
        <div class="col-lg-4">
            <a class="approve-back-to-store" href="{{ route('products.index') }}">
                <i class="bi bi-arrow-left-square"></i>
                <span>
                    Продовжити покупки у крамниці
                </span>
            </a>
        </div>
        <div class="col-lg-3">
            <a class="approve-cart-link" href="{{ route('carts.index') }}">
                <span>
                    Перейти до кошика
                </span>
                <i class="bi bi-cart-check"></i>
            </a>
        </div>

    </div>


    {{-- @if (isset($sugests)) --}}
    <div class="row">
        <h2>Вас також може зацікавити</h2>
        @foreach ($sudgests as $sudgest)
        <div class="col-lg-2">
            <img style="width: 100%" src="{{ $sudgest->main_img }}" alt="">
            <div class="">
                {{ $sudgest->name }}
            </div>
        </div>
        @endforeach
    </div>
    {{-- @endif --}}
</div>

@endsection
