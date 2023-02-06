<div class="row product-content-wrap">
    @foreach ($products as $product)
        <div class="products-card-wrapp col-sm-12 col-md-6 col-lg-5 col-xl-4 @if ($product->quantity <= 0) product-out-of-stock @endif">
            <div class="products-card-inside ">
                <a href="{{ route('products.show', $product->slug) }}">

                    <div class="prod-image" style="background-image: url('{{str_replace('product-img', 'product-img-medium', $product->main_img)}}')" alt="{{ $product->name }}">
                            {{-- <img src="{{str_replace('product-img', 'product-img-medium', $product->main_img)}}" alt="{{ $product->name }}"> --}}
                            @if ($product->old_price != 0)
                                <div class="sale-at">
                                    Знижка!
                                </div>
                            @endif
                    </div>
                </a>

                <div class="product-status-wrap my-2">
                    @if ( $product->status === 'in_stock' )
                        <div class="prod-status">
                            У наявності
                        </div>
                    @elseif ($product->status === 'out_of_stock')
                        <div class="prod-status">
                            Немає в наявності
                        </div>
                    @elseif ($product->status === 'for_order')
                        <div class="prod-status">
                            Під замовлення
                        </div>
                    @endif
                </div>
                <a class="product-title-link" href="{{ route('products.show', $product->slug) }}">
                    <h3> {{ $product->name }} </h3>
                </a>
                <div class="price-block my-4">
                    @if ($product->old_price != 0)
                        <div class="prod-old-price">
                            {{ $product->old_price }} ₴
                        </div>
                        <div class="prod-price-with-sale ms-2">
                            {{ $product->price }} ₴
                        </div>
                    @else
                        <div class="prod-price">
                            {{ $product->price }} ₴
                        </div>
                    @endif
                    <div class="prod-price-type ms-2">
                        /{{ $product->price_type }}
                    </div>
                </div>
                <div class="d-flex buttons-group-index-product my-3">
                    <a class="btn index-product-btn me-2" href="{{ route('products.show', $product->slug) }}">
                        <i class="bi bi-eye"></i>
                    </a>
                    {{-- <form class="d-block" action="">
                        @csrf
                        <button class="btn index-product-btn ">
                            <i class="bi bi-bag-heart"></i>
                        </button>
                    </form> --}}
                    <button class="btn index-product-btn js-btn-add-to-cart ms-5 @if ($product->quantity <= 0) disabled @endif" type="submit"
                    onclick="add_button_cart(this, {{ $product->id }})"
                    max="{{ $product->quantity }}">
                        <i class="bi bi-cart-plus"></i>
                        <span class="cart-count-porduct">{{ $cart[$product->id] ?? '' }}</span>
                    </button>
                    <form class="product-btn-add-to-cart-index" action="{{ route('addToCart', $product) }}"
                    method="POST">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    @endforeach
</div>
