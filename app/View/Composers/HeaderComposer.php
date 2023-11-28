<?php

namespace App\View\Composers;

use Illuminate\View\View;
use App\Models\ProductType;

class HeaderComposer
{
    public function compose(View $view)
    {
        $productsType = ProductType::all(); // Или любой другой запрос, который тебе нужен
        $view->with('productsType', $productsType);
    }
}
