{{-- <div class="container"> --}}
    <div>
        <div class="category-page-wrap mt-3">
            <div class="category-page-wrap-left">
                @if ($category)
                    <img style="width: 100%" src="{{ $category->main_img }}" alt="">
                @else
                    <img style="width: 100%" src="{{ asset('/images/consumer.png') }}" alt="">
                @endif
            </div>
            <div class="category-page-wrap-right">
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
                        Фермерське господарство «Looschen» з Ольденбурга Мюнстерланда налічує понад 300-річний досвід у розведенні великої рогатої худоби протягом кількох поколінь. З наміром визначити правильні напрямки майбутнього розвитку ферми протягом останнього десятиліття ми успішно розширили нашу діяльність до розведення корів породи вагю. Wagyu Auetal поєднує розведення великої рогатої худоби «Made in Germany» з найкращою та найціннішою породою корів у світі.
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
                <div class="row pb-3">
                    <div class="col-6">
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
