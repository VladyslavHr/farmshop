<div class="row product-content-wrap">
    @foreach ($products as $product)
        <div class="products-card-wrapp col-sm-12 col-md-6 col-lg-5 col-xl-4">
            <div class="products-card-inside">
                <div class="prod-image">
                    <a href="{{ route('products.show', $product->slug) }}">
                        <img style="width: 100%" src="{{str_replace('product-img', 'product-img-small', $product->main_img)}}" alt="{{ $product->name }}">
                        @if ($product->old_price != 0)
                            <div class="sale-at">
                                Знижка!
                            </div>
                        @endif
                    </a>
                </div>
                <div class="product-status-wrap my-2">
                    @if ( $product->status === 'in_stock' )
                        <div class="prod-status">
                            В наявності
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
                        <div class="prod-price-with-sale text-danger ms-2">
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
                <div class="d-flex buttons-group-index-product my-2">
                    <a class="btn index-product-btn" href="{{ route('products.show', $product->slug) }}">
                        <i class="bi bi-eye"></i>
                    </a>
                    <form class="d-block" action="">
                        @csrf
                        <button class="btn index-product-btn ">
                            <i class="bi bi-bag-heart"></i>
                        </button>
                    </form>
                    <button class="btn index-product-btn js-btn-add-to-cart" type="submit"
                    onclick="add_button_cart(this, {{ $product->id }})"
                    max="{{ $product->quantity }}">
                        <i class="bi bi-bag-plus"></i>
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
