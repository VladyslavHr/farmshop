<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Http\Classes\Cart;

class ProductAddToCartButton extends Component
{
    public ?int $productCartCount;
    public int $addToCartCount = 1;
    public $product;
    public bool $showCartLink = false;

    public function addToCart(): void
    {
        $cart = Cart::addProduct($this->product->id, $this->addToCartCount);

        $this->productCartCount = $cart[$this->product->id];

        $this->showCartLink = $this->productCartCount > 0;

        // Cart::getTotalCount()

        $this->emit('cartTotalCountUpdated', Cart::getTotalCount());

    }

    public function mount()
    {
        $this->productCartCount = Cart::getProductCount($this->product->id);

        $this->showCartLink = $this->productCartCount > 0;
    }


    public function render()
    {
        return view('livewire.product-add-to-cart-button');
    }


}
