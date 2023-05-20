@extends('layouts.app')

@section('title', 'Фермерські продукти, фермерські товари, еко-продукти, здорове харчування')
@section('description', 'Фермерські продукти, фермерські товари, еко-продукти, здорове харчування, рослини, овочі, фрукти, Еко ферма, крамниця, купити')
@section('keywords', 'Еко ферма, еко продукти, фермерські продукти, здорове харчування, рослини, овочі, фрукти')
@section('content')

<div class="container">
    @livewire('products-category-filter')
</div>

@endsection
