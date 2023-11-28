<nav class="navbar navbar-expand-md navbar-light shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{-- {{ config('app.name', 'Wildfarm') }} --}}
            @include('layouts/blocks/logo')

        </a>
        <button class="navbar-toggler burger-menu-btn" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav me-auto align-items-center">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                            <i class="bi bi-shop"></i>
                            Крамниця
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownShop">
                            <a class="dropdown-item drop-item
                            {{ request()->routeIs('products.index') ? 'active-link' : '' }}"
                            href="{{ route('products.index') }}">
                                Крамниця
                            </a>
                            @foreach ($productsType as $type)
                                <a class="dropdown-item drop-item
                                {{ request()->routeIs('productTypes.show') && request()->slug == $type->slug ? 'active-link' : '' }}"
                                href="{{ route('productTypes.show', $type->slug) }}">
                                    {{$type->name}}
                                </a>
                            @endforeach
                        </div>

                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('contacts.index') }}">
                            <i class="bi bi-telephone"></i>
                            Контакти
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                            <i class="bi bi-info-circle"></i>
                            Довідка
                        </a>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item drop-item" href="{{ route('contacts.payAndDelivery') }}">
                                Доставка та оплата
                            </a>
                            <a class="dropdown-item drop-item" href="{{ route('contacts.retunrRules') }}">
                                Повернення товару
                            </a>
                        </div>
                    </li>
            </ul>
            <div class="cart-block-header d-flex">
                <a class="nav-link me-3 " href="{{ route('carts.index') }}" >
                    <i class="bi bi-cart-check"></i>
                    Кошик (<b id="cart_total_count" class="cart-count">{{ Cart::getTotalCount() }}</b>)
                </a>
                @if (Auth::check())
                    @if (auth()->user()->admin == 1)
                    <a class="nav-link me-3" href="{{ route('admin.dashboard.index') }}" role="button" aria-haspopup="true" aria-expanded="false" v-pre>
                        Admin
                    </a>
                    @endif
                    {{-- <a class="nav-link me-3" href="{{ route('parsers.agriculture') }}" role="button" aria-haspopup="true" aria-expanded="false" v-pre>
                        Agriculture
                    </a> --}}
                @endif
            </div>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ms-auto">
                <!-- Authentication Links -->
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Увійти</a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">Зареєструватись</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a href="{{ route('profile.show', UserCrypt::encryptedId(Auth::user()->id) ) }}" class="dropdown-item drop-item {{ request()->routeIs('profile.show') ? 'active-link' : '' }}">
                                Мій профіль
                            </a>
                            <a class="dropdown-item drop-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                Вийти
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
