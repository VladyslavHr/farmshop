@extends('layouts.app')

@section('page-title', 'Товар')

@section('content')
<div class="background-page-show py-5">

    <div class="container page-show">
        <div class="row">
            <div class="col-lg-6">
                <img class="product-img-show" src="{{$product->main_img}}" alt="">
            </div>
            <div class="col-lg-6 product-show-right-info">
                <h1>{{ $product->name }}</h1>
                <div class="product-show-price-block pt-4">
                    @if ($product->old_price != 0)
                    <div class="product-show-old-price">
                        {{ $product->old_price }} грн.
                    </div>
                    @endif
                    <div class="product-show-price ms-2">
                        {{ $product->price }} грн.
                    </div>
                    <div class="product-show-type-price ms-2">
                        /{{ $product->price_type }}
                    </div>
                </div>

                <div class="product-show-describtion py-5">
                    {{$product->description}}
                </div>
                <livewire:product-add-to-cart-button :product="$product">
                {{-- <form action="{{ route('carts.approve', $product) }}" method="POST" class="product-show-add-to-cart pt-4">
                    @csrf





                </form> --}}


                {{-- <button class="product-show-link-to-card mt-3" type="submit">
                    Додати до кошика
                    <span class="cart-count-porduct">{{ $cart[$product->id] ?? '' }}</span>
                </button> --}}

                {{-- <div class="product-show-add-to-cart pt-4">
                    <input class="product-show-input-quantity" inputmode="numeric" type="number"
                    value="{{ $product->cart_quantity }}"
                    max="{{ $product->quantity }}"
                    data-productid="{{ $product->id }}"
                    oninput="cart_item_quantity_change(this)">



                    <button class="product-show-link-to-card" type="submit"
                    onclick="add_button_cart(this, {{ $product->id }})">
                        Додати до кошика
                        <span class="cart-count-porduct">{{ $cart[$product->id] ?? '' }}</span>
                    </button>



                    <form class="product-btn-add-to-cart-index" action="{{ route('addToCart', $product) }}"
                    method="POST">
                        @csrf
                    </form>
                </div> --}}


                {{-- <form class="product-show-add-to-cart pt-4">
                    <input class="product-show-input-quantity" inputmode="numeric" type="number">
                    <button type="submit" class="product-show-link-to-card">Додати до кошика</button>
                </form> --}}

                <form action="" class="pt-5">
                    <a href="#" class="product-show-favorite-link-add">
                        <i class="bi bi-bag-heart me-2 favorite-icon-link"></i>
                        <span>
                            Додати до бажанного
                        </span>
                    </a>
                </form>

                <div class="product-show-category pt-5">
                    <span class="product-show-category-title">
                        Категорія:
                    </span>
                    <span class="product-show-category-name-res ms-2">
                        {{ $product->category->name }}
                    </span>
                </div>

            </div>
        </div>

        <div class="col-md-12 pt-5">
            {{ $product->description }}
        </div>
    </div>

</div>
@endsection
