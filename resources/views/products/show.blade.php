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

                <form class="product-show-add-to-cart pt-4">
                    <input class="product-show-input-quantity" inputmode="numeric" type="number">
                    <button type="submit" class="product-show-link-to-card">Додати до кошика</button>
                </form>

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
                {{-- <div class="product-show-devide-line"></div> --}}

                {{-- <div class="row pt-5"> --}}
                    {{-- @if ( $product->status === 'in_stock' )
                        <div class="col-md-3">
                            В наявності
                        </div>
                    @elseif ($product->status === 'out_of_stock')
                        <div class="col-md-3">
                            Немає в наявності
                        </div>
                    @elseif ($product->status === 'for_order')
                        <div class="col-md-3">
                            Під замовлення
                        </div>
                    @endif --}}
                    {{-- @if ($product->old_price != 0)
                        <div class="col-md-3">
                            {{ $product->old_price }} грн.
                        </div>
                    @endif
                    <div class="col-md-3">
                        {{ $product->price }} грн.
                    </div>
                    <div class="col-md-3">
                        /{{ $product->price_type }}
                    </div> --}}
                {{-- </div> --}}
                {{-- <div class="adding-to-cart-show pt-5">
                    <div class="adding-to-cart-title">
                        Оберіть кількість
                    </div>
                    <div class="adding-to-cart-count-minus">
                        <button class="btn">
                            <i class="bi bi-dash-square"></i>
                        </button>
                    </div>
                    <div class="adding-to-cart-count">
                        <input class="cart-count-input" type="text" value="1">
                    </div>
                    <div class="adding-to-cart-count-plus">
                        <button class="btn">
                            <i class="bi bi-plus-square"></i>
                        </button>
                    </div>
                    <div class="adding-to-cart-action">
                        <button class="btn">
                            <i class="bi bi-bag-plus"></i>
                        </button>
                    </div>
                </div>
                <div class="col-lg-12 pt-5">
                    <button class="btn btn-warning">
                        Додати до бажанного
                        <i class="bi bi-bag-heart"></i>
                    </button>
                    <button class="btn btn-primary">
                        Додати до кошика
                        <i class="bi bi-bag-plus"></i>
                    </button>
                </div> --}}
            </div>
        </div>

        <div class="col-md-12 pt-5">
            {{ $product->description }}
        </div>
    </div>

</div>
@endsection
