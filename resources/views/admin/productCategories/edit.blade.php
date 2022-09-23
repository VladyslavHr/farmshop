@extends('admin.layouts.adminapp')

@section('page-title', 'Редагування категорії')

@section('content')
@include('admin.layouts.blocks.errors')
<div class="container py-3">
    <div class="row py-3">
        <div class="col-md-2">
            <a class="btn " href="{{ route('admin.productCategories.index') }}">
                <i class="bi bi-arrow-left-square me-2"></i>
                Повернутись
            </a>
        </div>
        <div class="col-md-2">
            <a class="btn " href="{{ route('admin.productCategories.create') }}">
                <i class="bi bi-plus-lg me-2"></i>
                Створити
            </a>
        </div>
        <div class="col-md-2">
            <form class="text-center" action="{{ route('admin.productCategories.delete', $product_category) }}" method="POST"
            onsubmit="if(!confirm('Видалити?')) return false">
            @method('DELETE')
            @csrf
            <button type="submit" class="btn"><i class="bi bi-trash me-2"></i> Видалити</button>
        </form>
        </div>
    </div>
    <form class="mt-3" action="{{ route('admin.productCategories.update', $product_category) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="mb-3 col-md-6">
                <label for="" class="form-label">Назва виду товару</label>
                <input name="name" value="{{ $product_category->name }}" type="text" class="form-control" id="">
                <span class="form-text">Будь ласка напишіть назву виду товару.</span>
            </div>
            <div class="mb-3 col-md-6">
                <span class="form-text">Оберіть будь ласка вид товару.</span>
                <span class="form-text">Обраний вид</span>
                <label for="">{{ $product_category->type->name }}</label>
                <select class="form-select" name="product_type_id" >
                    @foreach ($product_types as $product_type)
                        <option {{ $product_type->id == $product_category->type->id ? 'selected' : '' }} value="{{$product_type->id }}">{{ $product_type->name }}</option>
                    @endforeach
                </select>
                <span class="form-text">Будь ласка обеіть вид до якого відноситься товар</span>
            </div>
            <div class="mb-3 col-md-12">
                <label for="description_product_category_create" class="form-label">Опис</label>
                <textarea name="description" class="form-control tinyeditor" id="description_product_category_create" cols="30" rows="10"
                >{{ $product_category->description }}</textarea>
            </div>
            <div class="mb-3 col-md-6">
                <label for="" class="form-label">SEO заголовок</label>
                <input name="seo_title" value="{{ $product_category->seo_title }}" type="text" class="form-control" id="" placeholder="">
                <span class="form-text">Будь ласка напишіть SEO заголовок.</span>
            </div>
            <div class="mb-3 col-md-6">
                <label for="" class="form-label">SEO ключові слова</label>
                <input name="seo_keywords" value="{{ $product_category->seo_keywords }}" type="text" class="form-control" id="" placeholder="">
                <span class="form-text">Будь ласка напишіть SEO ключові слова.</span>
            </div>
            <div class="mb-3 col-md-6">
                <label for="" class="form-label">SEO опис</label>
                <input name="seo_description" value="{{ $product_category->seo_description }}" type="text" class="form-control" id="" placeholder="">
                <span class="form-text">Будь ласка напишіть SEO опис.</span>
            </div>
            <div class="col-md-6 mb-3">
                <label for="inputLogoFile" class="form-label">Логотип</label>
                <input name="logo" type="file" class="form-control" id="inputLogoFile">
            </div>
            <div class="col-md-6 mb-3">
                <label for="" class="form-label">Картинка</label>
                <input name="main_img" type="file" class="form-control" id="inputMainImgFile">
            </div>
            <div class="mb-3 col-md-3">
                <span>Логотип</span>
                <img style="width: 100%" src="{{ $product_category->logo }}" alt="">
            </div>
            <div class="mb-3 col-md-3">
                <span>Картинка</span>
                <img style="width: 100%" src="{{ $product_category->main_img }}" alt="">
            </div>
        </div>
        <button type="submit" class="btn btn-primary col-md-1" >Створити</button>
    </form>
</div>

@endsection
