<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\{ProductCategory,ProductType,Product};
use Livewire\WithPagination;

class TypeCategoryFilter extends Component
{
    use WithPagination;

    public $paginationTheme = 'bootstrap';

    public $type;
    public $category;
    public $categories;
    public $choosenCategorySlug = 'all';
    public $productTypeSlug;
    public $sortingSelectValue = null;
    public $sortingBy = 'name';
    public $sortingDirection = 'asc';
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
        // bar(request()->all());
        $this->queryParams = array_merge($this->queryParams, $params);

        $queryString = '?' . http_build_query($this->queryParams);

        $this->emit('urlChange', $queryString);

        $this->resetPage();

    }

    public function mount()
    {
        $this->queryParams = $_GET;
        $this->productTypeSlug = request('slug');
        $this->sortingBy = request('sortingBy') ?? 'name';
        $this->sortingDirection = request('sortingDirection') ?? 'asc';
        $this->sortingSelectValue = $this->sortingBy . '_' . $this->sortingDirection;
    }

    public function render()
    {



        if (request('category')) {
            $this->choosenCategorySlug = request('category');
        }

        $productType = ProductType::where('slug', $this->productTypeSlug)->first();

        $this->category = ProductCategory::where('slug', $this->choosenCategorySlug)->first();

        $this->categories = $productType->categories;

        if ($this->category) {
            $products = $this->category->products()->orderBy($this->sortingBy, $this->sortingDirection)->paginate(10);
        }else{
            $products = $productType->products()->orderBy($this->sortingBy, $this->sortingDirection)->paginate(10);
        }

        return view('livewire.type-category-filter', [
            'cart' => session('cart', []),
            'products' => $products,
        ]);


    }
}
