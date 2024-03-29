{{-- <div class="container"> --}}
<div>
    <div class="row pt-3" style="min-height: 440px">
        <div class="col-xl-3 category-page-img-wrap">
            @if ($category)
                @if ($category->main_img == '/images/no-thumb-r.jpg')
                {{-- <div class="back-image-standart" style="background-image: url('/images/kram-log.jpeg')"></div> --}}
                    <img style="width: 100%; max-height: 440px;" src="{{ asset('/images/kram-log.jpg') }}" alt="">
                @else
                    <img style="width: 100%; max-height: 440px;" src="{{ str_replace('product-categories-logo', 'product-categories-logo-small', $category->logo) }}" alt="">
                @endif
            {{-- @elseif ($product_types)
                @if ($product_types->main_img == '/images/no-thumb-r.jpg')
                    <img style="width: 100%; height: 100%" src="{{ asset('/images/kram-log.jpeg') }}" alt="">
                @else
                    <img style="width: 100%; height: 100%" src="{{ str_replace('product-type-logo', 'product-type-logo-small', $product_types->logo) }}" alt="">
                @endif --}}
            @else
                <img style="width: 100%; max-height: 440px;" src="{{ asset('/images/kram-log.jpg') }}" alt="">
            @endif
            {{-- <div class="back-image-standart" style="background-image: url('/images/kram-log.jpeg')"></div> --}}
        </div>
        <div class="col-xl-9 category-page-text-wrap">
            @if ($category)
            <div class="category-page-text-wrap-bg">
                <div class="category-page-title">
                    <h1>{{ $category->name }}</h1>
                </div>
                <div class="category-page-text">
                    {{ $category->description }}
                </div>
            </div>
            @else
            <div class="category-page-text-wrap-bg">
                <div class="category-page-title">
                    <h1>Крамниця</h1>
                </div>
                <div class="category-page-text">
                    Наша крамниця пропонує широкий асортимент фермерських продуктів та рослин, які вирощуються на місцевій фермі без використання хімічних добрив та пестицидів.
                    Ми дотримуємось екологічних стандартів і гарантуємо якість своїх продуктів.
                    У нашому асортименті ви знайдете свіжі фрукти та овочі, які вирощуються в залежності від сезону.
                    Ми також пропонуємо різноманітні сорти меду, свіжі яйця від курей, які знаходяться на вільному вигулі.
                    {{-- та молочні продукти від місцевих фермерів --}}
                    У нашому магазині ви зможете знайти також широкий вибір рослин, які підходять для вирощування вдома, на городі чи на балконі.
                    Ми пропонуємо насіння овочів, фруктів та ягід, різноманітні сорти квітів та рослин для декорування вашого саду чи кімнати.
                    Ми прагнемо забезпечити наших клієнтів тільки найкращою якістю продуктів та рослин, а також професійним підходом до обслуговування.
                    Наші працівники завжди готові допомогти вам з вибором потрібних продуктів та рослин та відповісти на всі ваші запитання.
                </div>
            </div>
            @endif
        </div>
    </div>

    <div class="row pt-5">
        <div class="side-filter col-lg-3">
            <h2 class="category-list-title">Категорії товарів</h2>
            <ul class="ctegorie-list-index">
                <li class="category-list-element">
                    <a href="all"
                        class="category-list-link"
                        wire:click.prevent="changeCategory('all')">
                        Всі категорії
                        @if ($choosenCategorySlug === 'all')
                            <i class="bi bi-check-lg"></i>
                        @endif
                    </a>
                </li>
                @foreach ($categories as $category)
                    @if (count($category->products))
                    <li class="category-list-element">
                        <a href="/tovary?category={{$category->slug}}"
                            class="category-list-link"
                            wire:click.prevent="changeCategory('{{ $category->slug }}')">
                            {{$category->name}}
                            @if ($category->slug == $choosenCategorySlug)
                                <i class="bi bi-check-lg"></i>
                            @endif
                        </a>
                    </li>
                    @endif

                @endforeach
            </ul>
        </div>
        <div class="main-content col-lg-9">
            <div class="row pb-3">
                <div class="col-6">
                    {{-- <select wire:model="sorting_price" wire:select="sortingPrice">
                        <option value="asc">от дешевых</option>
                        <option value="desc">от дорогих</option>
                    </select> --}}
                    <select wire:model="sortingSelectValue" class="form-select sorting-select">
                        <option value="price_asc">Спочатку дешеві</option>
                        <option value="price_desc">Спочатку доргі</option>
                        <option value="name_asc">За назвою</option>
                        <option value="quantity_desc">За кількістю</option>
                    </select>
                </div>
                <div class="col-6">
                    {{ $products->links() }}
                </div>
            </div>

            @include('products.blocks.productsList')

            <div class="col-lg-12 pt-3">
                {{ $products->links() }}
            </div>
        </div>
    </div>
</div>
{{-- </div> --}}
