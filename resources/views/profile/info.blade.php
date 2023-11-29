@extends('layouts.app')

@section('content')
@if (session('status'))
<div class="alert alert-success" role="alert">
    {{ session('status') }}
</div>
@elseif (session('error'))
<div class="alert alert-danger" role="alert">
    {{ session('error') }}
</div>
@endif
<div class="container py-5">
    <h1 class="text-center">Ласкаво просимо до вашого профілю {{ $user->name }} {{ $user->last_name }}</h1>

    @include('profile.blocks.nav')

    <form action="{{ route('profile.infoUpdate', UserCrypt::encryptedId($user->id)) }}" method="POST" >
        @csrf
        @method('PUT')

        <div class="row align-items-center">
            <div class="col-lg-6">
                <h3 class="py-5">Контактна інформація</h3>
            </div>
            <div class="col-lg-6">
                <div class="wrap-chekbox">
                    <label class="label-for-checkbox me-3" for="selfship_check">Самовивіз</label>
                    <input type="checkbox" name="selfship" id="selfship_check" class="selfship-checkbox form-check-input" {{ old('selfship', $user->selfship) ? 'checked' : '' }}>
                </div>

            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="user_create_name" class="form-label">Ім'я</label>
                <input name="name" value="{{ old('name', $user->name) }}" type="text" class="input-checkout @error ('name') is-invalid @enderror" id="user_create_name">
                <span class="form-text">Буль ласка напишіть Ім'я. (Обов'язково)</span>
                <div class="invalid-feedback">
                    @error ('name') {{$message}}@enderror
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <label for="user_create_last_name" class="form-label">Прізвище</label>
                <input name="last_name" value="{{ old('last_name', $user->last_name) }}" type="text" class="input-checkout @error ('last_name') is-invalid @enderror" id="user_create_last_name">
                <span class="form-text">Буль ласка напишіть Прізвище.</span>
                <div class="invalid-feedback">
                    @error ('last_name') {{$message}}@enderror
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <label for="user_create_email" class="form-label">Електронна пошта</label>
                <input name="email" value="{{ old('email', $user->email)}}" type="email" class="input-checkout @error ('email') is-invalid @enderror" id="user_create_email">
                <span class="form-text">Буль ласка напишіть Електроннау пошту. (Обов'язково)</span>
                <div class="invalid-feedback">
                    @error ('email') {{$message}}@enderror
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <label for="user_create_phone" class="form-label">Телефон</label>
                <input name="phone" value="{{ old('phone', $user->phone)}}" type="tel" class="input-checkout @error ('phone') is-invalid @enderror" id="user_create_phone">
                <span class="form-text">Буль ласка напишіть Телефон.</span>
                <div class="invalid-feedback">
                    @error ('phone') {{$message}}@enderror
                </div>
            </div>
        </div>
        <h3 class="text-center py-3">Адреса для доставки Новою Поштою</h3>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="user_create_street" class="form-label">Номер пошти</label>
                <input name="new_post_num" value="{{ old('new_post_num', $user->new_post_num) }}" type="number" class="input-checkout @error ('new_post_num') is-invalid @enderror" id="user_create_street">
                <span class="form-text">Буль ласка напишіть номер пошти.</span>
                <div class="invalid-feedback">
                    @error ('new_post_num') {{$message}}@enderror
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <label for="user_create_add_address" class="form-label">Населенний пункт</label>
                <input name="new_post_city" value="{{ old('new_post_city', $user->new_post_city) }}" type="text" class="input-checkout @error ('new_post_city') is-invalid @enderror" id="user_create_add_address">
                <span class="form-text">Буль ласка напишіть населенний пункт.</span>
                <div class="invalid-feedback">
                    @error ('new_post_city') {{$message}}@enderror
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <label for="user_create_post_code" class="form-label">Адреса нової пошти</label>
                <input name="new_post_adress" value="{{ old('new_post_adress', $user->new_post_adress) }}" type="text" class="input-checkout @error ('new_post_adress') is-invalid @enderror" id="user_create_post_code">
                <span class="form-text">Буль ласка напишіть адресу нової пошти.</span>
                <div class="invalid-feedback">
                    @error ('new_post_adress') {{$message}}@enderror
                </div>
            </div>
        </div>
        <button type="submit" class="float-end btn send-submit">Оновити</button>



    </form>


</div>

@endsection
