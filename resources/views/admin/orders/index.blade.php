@extends('admin.layouts.adminapp')

@section('page-title', 'Список замовлень')

@section('content')

<div class="container">

    <div class="row">
        @foreach ($orders as $order)
        <div class="col-lg-1">{{$order->id }}</div>
        <div class="col-lg-2">{{$order->name }}</div>
        {{-- <div class="">{{$order-> }}</div>
        <div class="">{{$order-> }}</div>
        <div class="">{{$order-> }}</div>
        <div class="">{{$order-> }}</div>
        <div class="">{{$order-> }}</div>
        <div class="">{{$order-> }}</div>
        <div class="">{{$order-> }}</div> --}}
        {{-- <div class="">{{$order-> }}</div> --}}
        @endforeach
    </div>

</div>


@endsection
