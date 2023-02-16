
<div class="product-show-add-to-cart pt-4" >

<input class="product-show-input-quantity me-2" type="number" min="0"
    wire:model="addToCartCount">


<button class=" btn product-show-link-to-card me-2 position-relative @if ($product->quantity <= 0) disabled @endif" type="button"
    wire:click="addToCart">
    Додати до кошика
    <span class="cart-count-porduct">{{ $productCartCount }}</span>
</button>
{{-- {{ $cart[$product->id] ?? '' }} --}}

@if ($showCartLink)
    <a href="{{ route('carts.index') }}" class="btn product-show-link-to-card" >
        до кошика
        {{-- <span class="cart-count-porduct">{{ $cart[$product->id] ?? '' }}</span> --}}
    </a>
@endif
</div>
