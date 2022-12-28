{{-- <div class="container"> --}}
    <div>
        <div class="row pt-3">
            <div class="col-xl-4 category-page-img-wrap">
                <img style="width: 100%" src="{{ asset('/images/consumer.png') }}" alt="">
            </div>
            <div class="col-xl-8 category-page-text-wrap">
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
                        A consumer good, also known as a ‘final good’, is the end product a business produces and is purchased by the consumer. For example, microwaves, fridges, t-shirts, and washing machines, are all examples of consumer goods. They are final goods that the consumer purchases.
                        Consumer goods contrast with intermediate goods in the fact that intermediate goods are used to create the final consumer good. Goods such as copper, coal, iron, or other raw materials, are not consumer goods because they are used to make a final consumer good. For instance, copper can be used to create trays, bowls, and other containers which are considered consumer products. These are examples of intermediate goods that are in turn used to create final consumer goods.
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
                        <a href="#"
                            class="category-list-link"
                            wire:click.prevent="changeCategory('all')">
                            Всі категорії
                            @if ($choosenCategorySlug === 'all')
                                <i class="bi bi-check-lg"></i>
                            @endif
                        </a>
                    </li>
                    @foreach ($categories as $category)
                        {{-- @if (count($category->products)) --}}
                        <li class="category-list-element">
                            <a href="#"
                                class="category-list-link"
                                wire:click.prevent="changeCategory('{{ $category->slug }}')">
                                {{$category->name}}
                                @if ($category->slug == $choosenCategorySlug)
                                    <i class="bi bi-check-lg"></i>
                                @endif
                            </a>
                        </li>
                        {{-- @endif --}}

                    @endforeach
                </ul>
            </div>
            <div class="main-content col-lg-9">
                @include('products.blocks.productsList')
            </div>
        </div>
    </div>
    {{-- </div> --}}
