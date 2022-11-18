@extends('admin.layouts.adminapp')

@section('page-title', 'Редагування товару')

@section('content')
@include('admin.layouts.blocks.errors')
<div class="container py-3">
    <div class="row py-3">
        <div class="col-md-2">
            <a class="btn " href="{{ route('admin.products.index') }}">
                <i class="bi bi-arrow-left-square me-2"></i>
                Повернутись
            </a>

        </div>
        <div class="col-md-2">
            <a class="btn " href="{{ route('admin.products.create') }}">
                <i class="bi bi-plus-lg me-2"></i>
                Створити
            </a>
        </div>
        <div class="col-md-2">
            <form class="text-center" action="{{ route('admin.products.delete', $product) }}" method="POST"
            onsubmit="if(!confirm('Видалити?')) return false">
            @method('DELETE')
            @csrf
            <button type="submit" class="btn"><i class="bi bi-trash me-2"></i> Видалити</button>
        </form>
        </div>
    </div>
    <form class="mt-3" action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="mb-3 col-md-6">
                <label for="" class="form-label">Назва товару</label>
                <input name="name" value="{{ $product->name }}" type="text" class="form-control" id="">
                <span class="form-text">Будь ласка напишіть назву товару.(обов'язково)</span>
            </div>
            <div class="mb-3 col-md-6">
                <span class="form-text">Оберіть будь ласка категорію товару.</span>
                <span class="form-text">Обрана категорія</span>
                <label for="">{{ $product->category->name }}</label>
                <select class="form-select" name="product_category_id" >
                    @foreach ($product_categories as $product_category)
                        <option {{ $product_category->id == $product->category->id ? 'selected' : '' }} value="{{$product_category->id }}">{{ $product_category->name }}</option>
                    @endforeach
                </select>
                <span class="form-text">Будь ласка обеіть категорію до якого відноситься товар(обов'язково)</span>
            </div>
            <div class="mb-3 col-md-6">
                <label for="" class="form-label">Ціна за одиницю</label>
                <input type="num" name="price" value="{{ $product->price }}" class="form-control">
                <span class="form-text">Будь ласка напишіть ціну</span>
            </div>
            <div class="mb-3 col-md-6">
                <label for="" class="form-label">Ціна до знижки</label>
                <input type="num" name="old_price" value="{{ $product->old_price }}" class="form-control">
                <span class="form-text">Будь ласка напишіть ціну яка є перед знижкою</span>
            </div>
            <div class="mb-3 col-md-4">
                <label for="" class="form-label">Вид ціни</label>
                <input name="price_type" value="{{ $product->price_type }}" type="text" class="form-control" id="">
                <span class="form-text">Будь ласка напишіть вид ціни (за одиницю, за кг, ...).</span>
            </div>
            <div class="mb-3 col-md-4">
                <label for="" class="form-label">Кількість</label>
                <input name="quantity" value="{{ $product->quantity }}" type="number" class="form-control" id="">
                <span class="form-text">Будь ласка напишіть кількість товару.</span>
            </div>
            <div class="mb-3 col-md-4">
                <label for="" class="form-label">Статус товару</label>
                <select name="status" id="" class="form-select">
                    <option value="in_stock" {{ $product->status == 'in_stock' ? 'selected' : '' }}>В наявності</option>
                    <option value="out_of_stock" {{ $product->status == 'out_of_stock' ? 'selected' : '' }}>Немає в наявності</option>
                    <option value="for_order" {{ $product->status == 'for_order' ? 'selected' : '' }}>Під замовлення</option>
                </select>
                {{-- <input name="status" value="{{ old('status') }}" type="text" class="form-control" id=""> --}}
                <span class="form-text">Будь ласка напишіть статут товару (в наявності, немає в наявності, під замовлення).</span>
            </div>
            <div class="mb-3 col-md-12">
                <label for="description_product_create" class="form-label">Опис</label>
                <textarea name="description" class="form-control tinyeditor" id="description_product_create" cols="30" rows="10"
                >{{ $product->description }}</textarea>
            </div>
            <div class="mb-3 col-md-6">
                <label for="" class="form-label">SEO заголовок</label>
                <input name="seo_title" value="{{ $product->seo_title }}" type="text" class="form-control" id="" placeholder="">
                <span class="form-text">Будь ласка напишіть SEO заголовок.(обов'язково)</span>
            </div>
            <div class="mb-3 col-md-6">
                <label for="" class="form-label">SEO ключові слова</label>
                <input name="seo_keywords" value="{{ $product->seo_keywords }}" type="text" class="form-control" id="" placeholder="">
                <span class="form-text">Будь ласка напишіть SEO ключові слова.(обов'язково)</span>
            </div>
            <div class="mb-3 col-md-6">
                <label for="" class="form-label">SEO опис</label>
                <input name="seo_description" value="{{ $product->seo_description }}" type="text" class="form-control" id="" placeholder="">
                <span class="form-text">Будь ласка напишіть SEO опис.(обов'язково)</span>
            </div>
            <div class="col-md-6 mb-3">
                <label for="" class="form-label">Картинка</label>
                <input name="main_img" type="file" class="form-control" id="inputMainImgFile">
            </div>
            <div class="col-md-6 mb-3">
                <div class="input-group">
                    <input name="gallery[]" type="file" class="form-control" id="create_product_gallery_input" multiple>
                    <label class="input-group-text" for="create_product_gallery_input">Галерея</label>
                    <div class="pt-3">
                        <span class="">Картинка</span>
                        <img style="width: 100%" src="{{ $product->main_img }}" alt="">
                    </div>


                </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                    @foreach ($product->gallery as $gallery)
                        <div class="col-md-4 position-relative" id="gallery_product_item_img">
                            <img class="img-thumbnail " src="{{ $gallery->image }}" alt="">
                            <button  onclick="galleryItemDelete(this, event)" type="button" class="gallery-item-delete"><i class="bi bi-x-lg"></i></button>
                        </div>
                    @endforeach
                </div>
            </div>
            {{-- <div class="mb-3 col-md-6">
                <span>Картинка</span>
                <img style="width: 100%" src="{{ $product->main_img }}" alt="">
            </div> --}}
        </div>
        <button type="submit" class="btn btn-primary col-md-1" >Змінити</button>
    </form>
</div>

@endsection
