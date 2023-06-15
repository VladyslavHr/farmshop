@extends('layouts.app')

@section('title', $product_types->seo_title)
@section('description', $product_types->seo_description)
@section('keywords', $product_types->seo_keywords)

@section('content')

<div class="container">
    @livewire('type-category-filter')
</div>


@endsection
