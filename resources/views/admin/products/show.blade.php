@extends('admin.layouts.adminapp')

@section('page-title', 'Інформація товару')

@section('content')

<div class="container py-3">
    <div class="row py-3">
        <div class="col-md-2">
            <a class="btn " href="{{ route('admin.products.index') }}">
                <i class="bi bi-arrow-left-square me-2"></i>
                Повернутись
            </a>

        </div>
        <div class="col-md-2">
            <a class="btn " href="{{ route('admin.products.edit', $product) }}">
                <i class="bi bi-pencil me-2"></i>
                Редагувати
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
    <div class="row py-3">
        <div class="col-md-9">
            <ul class="product-info-page-info-list">
                <li>
                    <span>
                        <strong>
                            Назва:
                        </strong>
                    </span>
                    <span>
                        {{ $product->name }}
                    </span>
                </li>
                <li>
                    <span>
                        <strong>
                            Категорія:
                        </strong>
                    </span>
                    <span>
                        {{ $product->category->name }}
                    </span>
                </li>
                <li>
                    <span>
                        <strong>
                            Ціна:
                        </strong>
                    </span>
                    <span>
                        {{ $product->price }}
                    </span>
                </li>
                <li>
                    <span>
                        <strong>
                            Ціна перед знижкою:
                        </strong>
                    </span>
                    <span>
                        {{ $product->old_price }}
                    </span>
                </li>
                <li>
                    <span>
                        <strong>
                            Вид ціни:
                        </strong>
                    </span>
                    <span>
                        {{ $product->price_type }}
                    </span>
                </li>
                <li>
                    <span>
                        <strong>
                            Статус:
                        </strong>
                    </span>
                    @if ($product->status === 'in_stock')
                        <span>В наявності</span>
                    @elseif ($product->status === 'out_of_stock')
                        <span>Немає в наявності</span>
                    @elseif ($product->status === 'for_order')
                        <span>Під замовлення</span>
                    @endif
                </li>
                <li>
                    <span>
                        <strong>
                            Кількість:
                        </strong>
                    </span>
                    <span>
                        {{ $product->quantity }}
                    </span>
                </li>
            </ul>
        </div>
        <div class="col-md-3 admin-product-show-image">
            {{-- <div class="row">
                <div class="col-md-6"> --}}
                    <img style="width: 100%" src="{{ $product->main_img }}" alt="">
                {{-- </div>
            </div> --}}
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            {{ $product->description }}
        </div>
    </div>

    <div class="devider mt-3"></div>


    <p class="py-2"><strong>Нотатки</strong></p>


    <form action="{{ route('admin.notes.store',  $product->id) }}" class="pb-3" method="POST">
        @csrf
        <div class="mb-3 col-md-12">
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <label for="note_product_create" class="form-label">Створити нотатку</label>
            <textarea name="note" class="form-control tinyeditor" id="note_product_create" cols="30" rows="10"
            >{{ old('note') }}</textarea>
            <button class="btn btn-primary float-end my-2">
                Створити
            </button>
        </div>

    </form>

    <div class="devider my-5"></div>

    {{-- {{$product->notes}} --}}
    @foreach ($product->notes as $note)
        @include('admin.components.notes')
    @endforeach

</div>

@endsection
