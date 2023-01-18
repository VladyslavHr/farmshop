<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\{ProductCategory,ProductType,Product};
use Livewire\WithPagination;

class TypeCategoryFilter extends Component
{
    use WithPagination;

    public $type;
    public $category;
    public $categories;
    public $choosenCategorySlug = 'all';
    public $productTypeSlug;
    public $sortingPrice = 'asc';
    public $sortingName = 'asc';
    public $sortingQuantity = 'desc';
    public $sortingBy = 'name';
    public $sortingDirection = 'asc';

    public function updateSortingName()
    {
        $this->sortingBy = 'name';
        $this->sortingDirection = $this->sortingName;
        bar('sorting_name => '. $this->sortingName);

    }

    public function updateSortingQuantity()
    {
        $this->sortingBy = 'quantity';
        $this->sortingDirection = $this->sortingQuantity;
        bar('sorting_quantity => '. $this->sortingQuantity);


    }

    public function updatedSortingPrice()
    {
        // if ( $this->sortingBy = 'price') {
        //     $this->sortingDirection = $this->sortingPrice;
        // }elseif ($this->sortingBy = 'name') {
        //     $this->sortingDirection = $this->sortingName;
        // }elseif ($this->sortingBy = 'quantity') {
        //     $this->sortingDirection = $this->sortingQuantity;
        // }

        if ($this->sortingBy = 'price') {
            $this->sortingDirection = $this->sortingPrice;
        }
        if ($this->sortingBy = 'name') {
            $this->sortingDirection = $this->sortingName;
        }
        if ($this->sortingBy = 'quantity') {
            $this->sortingDirection = $this->sortingQuantity;
        }

        // $this->sortingBy = 'price';
        // $this->sortingDirection = $this->sortingPrice;
        // $this->sortingBy = 'name';
        // $this->sortingDirection = $this->sortingName;
        // $this->sortingBy = 'quantity';
        // $this->sortingDirection = $this->sortingQuantity;



        bar('sorting_price => '. $this->sortingPrice);
    }

    public function filterProducts()
    {


    }

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
            $products = $this->category->products()->orderBy($this->sortingBy, $this->sortingDirection)->simplePaginate(2);
        }else{
            // bar($productType);
            $products = $productType->products()->orderBy($this->sortingBy, $this->sortingDirection)->simplePaginate(2);
            // $this->products = $productType->categories->reduce(function($products, $category)
            // {
            //     // \Debugbar::info($products);
            //    return $products->merge($category->products);
            // }, collect([]));
        }

        return view('livewire.type-category-filter', [
            'cart' => session('cart', []),
            'products' => $products,
        ]);


    }
}
