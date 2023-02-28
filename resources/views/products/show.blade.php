@extends('layouts.app')

@section('title', $product->seo_title)
@section('description', $product->seo_description)
@section('keywords', $product->seo_keywords)
@section('page-title', 'Товар')

@section('content')
<div class="background-page-show py-5">

    <div class="container page-show">
        <div class="row">
            <div class="col-lg-6">
                {{-- @include('/products/blocks/fancybox') --}}
                @include('components.fancybox')
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

                @livewire('product-add-to-cart-button', ['product' => $product])

                {{-- <form action="" class="pt-5">
                    <a href="#" class="product-show-favorite-link-add">
                        <i class="bi bi-bag-heart me-2 favorite-icon-link"></i>
                        <span>
                            Додати до бажанного
                        </span>
                    </a>
                </form> --}}

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

        {{-- <div class="row">
            @foreach ($interest_category->products as $interest)
                <div class="col-lg-3">
                    <h3>{{ $interest->name }}</h3>
                    <img src="{{ $interest->main_img }}" alt="">
                </div>
            @endforeach
        </div> --}}
        {{-- <div class="col-md-12 pt-5">
            {{ $product->description }}
        </div> --}}
    </div>

</div>
@endsection
