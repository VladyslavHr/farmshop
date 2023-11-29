<nav class="nav nav-pills nav-fill py-5">
    <a class="nav-link nav-link-bs {{ request()->routeIs('profile.show') ? 'active-bs' : '' }}" aria-current="page" href="{{ route('profile.show', UserCrypt::encryptedId($user->id)) }}">Мій профіль</a>
    <a class="nav-link nav-link-bs {{ request()->routeIs('profile.info') ? 'active-bs' : '' }}" href="{{ route('profile.info',  UserCrypt::encryptedId($user->id)) }}">Контактна інформація</a>
    <a class="nav-link nav-link-bs {{ request()->routeIs('profile.orders') ? 'active-bs' : '' }}" href="{{ route('profile.orders',  UserCrypt::encryptedId($user->id)) }}">Замовлення</a>
    {{-- <a class="nav-link nav-link-bs {{ request()->routeIs('profile.return') ? 'active-bs' : '' }}" href="{{ route('profile.return',  UserCrypt::encryptedId($user->id)) }}">Return</a> --}}
    <a class="nav-link nav-link-bs {{ request()->routeIs('profile.password') ? 'active-bs' : '' }}" aria-disabled="true" href="{{ route('profile.password',  UserCrypt::encryptedId($user->id)) }}">Пароль</a>
</nav>

