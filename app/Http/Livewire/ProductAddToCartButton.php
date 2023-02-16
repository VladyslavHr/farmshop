<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Http\Classes\Cart;

class ProductAddToCartButton extends Component
{
    // public ?int $productCartCount;
    // public $product_count = [];
    public $addToCartCount = 1;
    public $product;
    public bool $showCartLink = false;

    public function addToCart(): void
    {
        $this->changeCount(0);

        $cart = Cart::addProduct($this->product->id, $this->addToCartCount);

        $this->productCartCount = $cart[$this->product->id];

        $this->showCartLink = $this->productCartCount > 0;

        // Cart::getTotalCount()

        $this->emit('cartTotalCountUpdated', Cart::getTotalCount());

    }

    public function changeCount($action)
    {
        $this->addToCartCount = (int)$this->addToCartCount;

        $this->addToCartCount += $action;

        if ($this->addToCartCount < 0) {
            $this->addToCartCount = 0;
        }

        if ($this->addToCartCount >= $this->product->quantity) {
            $this->addToCartCount = $this->product->quantity;
        }
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
