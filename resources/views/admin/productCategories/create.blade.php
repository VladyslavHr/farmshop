@extends('admin.layouts.adminapp')

@section('page-title', 'Створення категорії товару')

@section('content')
@include('admin.layouts.blocks.errors')
<div class="container py-3">
    <form class="mt-3" action="{{ route('admin.productCategories.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="mb-3 col-md-6">
                <label for="" class="form-label">Назва категорії товару</label>
                <input name="name" value="{{ old('name') }}" type="text" class="form-control" id="">
                <span class="form-text">Будь ласка напишіть назву категорії товару.</span>
            </div>
            <div class="mb-3 col-md-6">
                <span class="form-text">Оберіть будь ласка вид товару.</span>
                <select class="form-select" name="product_type_id" >
                    @foreach ($product_types as $product_type)
                        <option value="{{ $product_type->id }}">{{ $product_type->name }}</option>
                    @endforeach
                </select>
                <span class="form-text">Будь ласка оберіть до якого виду категорія належить </span>
            </div>
            <div class="mb-3 col-md-12">
                <label for="description_product_category_create" class="form-label">Опис</label>
                <textarea name="description" class="form-control tinyeditor" id="description_product_category_create" cols="30" rows="10"
                >{{ old('description') }}</textarea>
            </div>
            <div class="mb-3 col-md-6">
                <label for="" class="form-label">SEO заголовок</label>
                <input name="seo_title" value="{{ old('seo_title') }}" type="text" class="form-control" id="" placeholder="">
                <span class="form-text">Будь ласка напишіть SEO заголовок.</span>
            </div>
            <div class="mb-3 col-md-6">
                <label for="" class="form-label">SEO ключові слова</label>
                <input name="seo_keywords" value="{{ old('seo_keywords') }}" type="text" class="form-control" id="" placeholder="">
                <span class="form-text">Будь ласка напишіть SEO ключові слова.</span>
            </div>
            <div class="mb-3 col-md-6">
                <label for="" class="form-label">SEO опис</label>
                <input name="seo_description" value="{{ old('seo_description') }}" type="text" class="form-control" id="" placeholder="">
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
        </div>
        <button type="submit" class="btn btn-primary col-md-1" >Створити</button>
    </form>
</div>

@endsection
