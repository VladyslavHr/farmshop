@extends('admin.layouts.adminapp')

@section('page-title', 'Створення категорії товару')

@section('content')
@include('admin.layouts.blocks.errors')
<div class="container py-3">
    <form class="mt-3" action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="mb-3 col-md-6">
                <label for="" class="form-label">Назва товару</label>
                <input name="name" value="{{ old('name') }}" type="text" class="form-control" id="">
                <span class="form-text">Будь ласка напишіть назву товару.</span>
            </div>
            <div class="mb-3 col-md-6">
                <span class="form-text">Оберіть будь ласка категорію товару.</span>
                <select class="form-select" name="product_category_id" >
                    @foreach ($product_categories as $product_category)
                        <option value="{{ $product_category->id }}">{{ $product_category->name }}</option>
                    @endforeach
                </select>
                <span class="form-text">Будь ласка оберіть до якої категорії належить товар.</span>
            </div>
            <div class="mb-3 col-md-6">
                <label for="" class="form-label">Ціна за одиницю</label>
                <input type="num" name="price" value="{{ old('price') }}" class="form-control">
                <span class="form-text">Будь ласка напишіть ціну</span>
            </div>
            <div class="mb-3 col-md-6">
                <label for="" class="form-label">Ціна до знижки</label>
                <input type="num" name="old_price" value="{{ old('old_price') }}" class="form-control">
                <span class="form-text">Будь ласка напишіть ціну яка є перед знижкою</span>
            </div>
            <div class="mb-3 col-md-6">
                <label for="" class="form-label">Вид ціни</label>
                <input name="price_type" value="{{ old('price_type') }}" type="text" class="form-control" id="">
                <span class="form-text">Будь ласка напишіть вид ціни (за одиницю, за кг, ...).</span>
            </div>
            <div class="mb-3 col-md-6">
                <label for="" class="form-label">Статус товару</label>
                <select name="status" id="" class="form-select">
                    <option value="in_stock">В наявності</option>
                    <option value="out_of_stock">Немає в наявності</option>
                    <option value="for_order">Під замовлення</option>
                </select>
                {{-- <input name="status" value="{{ old('status') }}" type="text" class="form-control" id=""> --}}
                <span class="form-text">Будь ласка напишіть статут товару (в наявності, немає в наявності, під замовлення).</span>
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
