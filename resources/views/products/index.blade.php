@extends('layouts.app')

@section('page-title', 'Усі товари')

@section('content')

<div class="container">
    @livewire('products-category-filter')
</div>

@endsection
