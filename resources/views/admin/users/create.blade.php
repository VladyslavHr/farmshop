@extends('admin.layouts.adminapp')

@section('page-title', 'Список користувачів')

@section('content')

<div class="container py-3">
    <form action="{{ route('admin.users.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="user_create_name" class="form-label">Ім'я</label>
                <input name="name" value="{{ old('name') }}" type="text" class="form-control" id="user_create_name">
                <span class="form-text">Будь ласка напишіть Ім'я.(обов'язково)</span>
            </div>
            <div class="col-md-6 mb-3">
                <label for="user_create_last_name" class="form-label">Фамілія</label>
                <input name="last_name" value="{{ old('last_name') }}" type="text" class="form-control" id="user_create_last_name">
                <span class="form-text">Будь ласка напишіть Фамілію.</span>
            </div>
            <div class="col-md-6 mb-3">
                <label for="user_create_email" class="form-label">Ел.Пошта</label>
                <input name="email" value="{{ old('email') }}" type="email" class="form-control" id="user_create_email">
                <span class="form-text">Будь ласка напишіть електронну пошту.(обов'язково)</span>
            </div>
            <div class="col-md-6 mb-3">
                <label for="user_create_phone" class="form-label">Телефон</label>
                <input name="phone" value="{{ old('phone') }}" type="phone" class="form-control" id="user_create_phone">
                <span class="form-text">Будь ласка напишіть телефон.</span>
            </div>
            <div class="col-md-6 mb-3">
                <label for="user_create_password" class="form-label">Пароль</label>
                <input name="password" type="password" class="form-control" id="user_create_password">
                <span class="form-text">Будь ласка створіть пароль.(обов'язково)</span>
            </div>
        </div>
        <button type="submit" class="btn btn-primary col-md-1">Створити</button>
    </form>
</div>


@endsection
