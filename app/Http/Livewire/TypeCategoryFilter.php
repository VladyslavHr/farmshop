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
    public $productTypeSlug;

    public function changeCategory($categorySlug)
    {
        $this->choosenCategorySlug = $categorySlug;

        $this->emit('urlChange', '?category=' . $categorySlug);
    }

    public function mount()
    {
        $this->productTypeSlug = request('slug');
    }

    public function render()
    {



        if (request('category')) {
            $this->choosenCategorySlug = request('category');
        }

        $productType = ProductType::where('slug', $this->productTypeSlug)->first();

        // \Debugbar::info($this->choosenCategorySlug);

        $this->category = ProductCategory::where('slug', $this->choosenCategorySlug)->first();

        $this->categories = $productType->categories;

        if ($this->category) {
            $this->products = $this->category->products;
        }else{
            // bar($productType);
            $this->products = $productType->products;
            // $this->products = $productType->categories->reduce(function($products, $category)
            // {
            //     // \Debugbar::info($products);
            //    return $products->merge($category->products);
            // }, collect([]));
        }



        return view('livewire.type-category-filter');
    }
}
