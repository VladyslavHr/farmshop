<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\{ProductCategory,Product,ProductType};
use Livewire\WithPagination;


class ProductsCategoryFilter extends Component
{

    use WithPagination;

    public $paginationTheme = 'bootstrap';


    public $category;
    public $categories;
    // public $products;
    public $choosenCategorySlug = 'all';
    // public $productTypeSlug;
    public $sortingSelectValue = null;
    public $sortingBy = 'quantity';
    public $sortingDirection = 'desc';
    public $queryParams = [];

    public function updatedSortingSelectValue()
    {
        // bar('sortingSelectValue => '. $this->sortingSelectValue);

        // if ($this->sortingSelectValue === 'price_asc') {
        //     $this->sortingBy = 'price';
        //     $this->sortingDirection = 'asc';
        // }

        // if ($this->sortingSelectValue === 'price_desc') {
        //     $this->sortingBy = 'price';
        //     $this->sortingDirection = 'desc';
        // }

        // if ($this->sortingSelectValue === 'name_asc') {
        //     $this->sortingBy = 'name';
        //     $this->sortingDirection = 'asc';
        // }

        // if ($this->sortingSelectValue === 'quantity_desc') {
        //     $this->sortingBy = 'quantity';
        //     $this->sortingDirection = 'desc';
        // }

        $this->sortingBy = explode('_', $this->sortingSelectValue)[0];
        $this->sortingDirection = explode('_', $this->sortingSelectValue)[1] ?? 'asc';
        $this->setQueryParams(['sortingBy' => $this->sortingBy, 'sortingDirection' => $this->sortingDirection]);

    }

    public function changeCategory($categorySlug)
    {
        $this->choosenCategorySlug = $categorySlug;

        // $this->emit('urlChange', '?category=' . $categorySlug);

        $this->setQueryParams(['category' => $categorySlug]);

    }

    public function setQueryParams($params = [])
    {
        $this->queryParams = array_merge($this->queryParams, $params);

        $queryString = '?' . http_build_query($this->queryParams);

        $this->emit('urlChange', $queryString);

        $this->resetPage();

    }

    public function mount()
    {
        $this->queryParams = $_GET;
        // $this->productTypeSlug = request('slug');
        $this->sortingBy = request('sortingBy') ?? 'quantity';
        $this->sortingDirection = request('sortingDirection') ?? 'desc';
        $this->sortingSelectValue = $this->sortingBy . '_' . $this->sortingDirection;
    }

    public function render()
    {
        // \Debugbar::info(request('slug'));
        // dd();


        if (request('category')) {
            $this->choosenCategorySlug = request('category');
        }

        $this->category = ProductCategory::where('slug', $this->choosenCategorySlug)->first();

        $this->categories = ProductCategory::all();

        $products = $this->category?->products() ?? Product::query();

        $products = $products->orderBy($this->sortingBy, $this->sortingDirection)->paginate(10);



        return view('livewire.products-category-filter', [
            'cart' => session('cart', []),
            'products' => $products,
        ]);
    }
}
