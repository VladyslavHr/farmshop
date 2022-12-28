<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\{ProductCategory,ProductType,Product};


class TypeCategoryFilter extends Component
{
    public $type;
    public $category;
    public $categories;
    public $products;
    public $choosenCategorySlug = 'all';

    public function changeCategory($categorySlug)
    {
        $this->choosenCategorySlug = $categorySlug;

        $this->emit('urlChange', '?category=' . $categorySlug);
    }

    public function render()
    {
        if (request('category')) {
            $this->choosenCategorySlug = request('category');
        }

        $this->category = ProductCategory::where('slug', $this->choosenCategorySlug)->first();

        $this->categories = ProductCategory::all();

        // $this->categories = ProductCategory::where('slug', $this->type)->first();

        $this->products = $this->category->products ?? Product::all();

        return view('livewire.type-category-filter');
    }
}
