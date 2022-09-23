@extends('admin.layouts.adminapp')

@section('page-title', 'Список користувачів')

@section('content')

<div class="container py-3">
    <form action="{{ route('admin.users.update', $user) }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="user_create_name" class="form-label">Jmeno</label>
                <input name="name" value="{{ $user->name }}" type="text" class="form-control" id="user_create_name">
                <span class="form-text">Prosím zadejte Jmeno.</span>
            </div>
            <div class="col-md-6 mb-3">
                <label for="user_create_last_name" class="form-label">Příjmení</label>
                <input name="last_name" value="{{ $user->last_name }}" type="text" class="form-control" id="user_create_last_name">
                <span class="form-text">Prosím zadejte Příjmení.</span>
            </div>
            <div class="col-md-6 mb-3">
                <label for="user_create_email" class="form-label">Email</label>
                <input name="email" value="{{ $user->email }}" type="email" class="form-control" id="user_create_email">
                <span class="form-text">Prosím zadejte Email.</span>
            </div>
            <div class="col-md-6 mb-3">
                <label for="user_create_phone" class="form-label">Telephone</label>
                <input name="phone" value="{{ $user->phone }}" type="phone" class="form-control" id="user_create_phone">
                <span class="form-text">Prosím zadejte Telephone.</span>
            </div>
        </div>
        <button type="submit" class="btn btn-primary col-md-1">Upravit</button>
    </form>

    <form action="{{ route('admin.users.updatePassword', $user) }}" method="POST">
        @csrf
        <div class="row pt-5 align-items-center">
            <div class="col-md-6">
                <label for="user_create_password" class="form-label">Heslo</label>
                <input name="password"  type="password" class="form-control" id="user_create_password">
                <span class="form-text">Prosím zadejte Heslo.</span>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary ">Upravit</button>
            </div>
        </div>
    </form>

</div>

@endsection
