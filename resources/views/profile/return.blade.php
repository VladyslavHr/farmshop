@extends('layouts.app')

@section('content')

<div class="container py-5">
    <h1 class="text-center">Ласкаво просимо до вашого профілю {{ $user->name }} {{ $user->last_name }}</h1>

    @include('profile.blocks.nav')

    @foreach ($user->orders as $order)
    <div class="row">
        <div class="col-lg-6">
            <div>
                <b>
                    Delivery Status: {{ $order->delivery_status }}
                    <i class="bi bi-check-lg text-success fs-4"></i>
                </b>
            </div>
            <div><b>Order: {{ $order->numeric_series }}</b></div>
            <div class="sub-color">From: {{ $order->created_at->format('d-m-Y') }}</div>
        </div>
        <div class="col-lg-6">
            <form action="">
                <button class="btn btn-main float-end">
                    Return the whole order
                </button>
            </form>
        </div>
    </div>

    @endforeach


</div>

@endsection
