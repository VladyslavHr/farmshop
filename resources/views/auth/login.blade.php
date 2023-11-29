@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center py-5">
        <div class="col-md-8 py-5">
            <div class="card">
                <div class="card-header">Вхід</div>
                {{-- {{ __('Login') }} --}}
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">Електронна пошта</label>
                            {{-- {{ __('Email Address') }} --}}
                            <div class="col-md-6">
                                <input id="email" type="email" class="input-checkout @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">Пароль</label>
                            {{-- {{ __('Password') }} --}}
                            <div class="col-md-6">
                                <input id="password" type="password" class="input-checkout @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input self-shipping-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{-- {{ __('Remember Me') }} --}}
                                        Запам'ятати мене
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn send-submit">
                                    {{-- {{ __('Login') }} --}}
                                    Вхід
                                </button>

                                {{-- @if (Route::has('password.reset'))
                                    <a class="btn btn-link" href="{{ route('password.reset') }}">
                                        {{ __('Forgot Your Password?') }}
                                        Забули пароль?
                                    </a>
                                @endif --}}
                                @if (Route::has('password.request'))
                                <a class="btn bsend-submit" href="{{ route('password.request') }}">
                                    {{-- {{ __('Forgot Your Password?') }} --}}
                                    Забули пароль?
                                </a>
                                @endif
                                {{-- @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        Забули пароль?
                                    </a>
                                @endif --}}
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
