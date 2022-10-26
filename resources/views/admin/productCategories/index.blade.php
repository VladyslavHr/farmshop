@extends('admin.layouts.adminapp')

@section('page-title', 'Список категорій')

@section('content')

<div class="container py-3">
    <div class="row py-3">
        <div class="col-md-2">
            <a class="btn " href="{{ route('admin.productCategories.create') }}">
                <i class="bi bi-plus-lg me-2"></i>
                Створити
            </a>
        </div>
    </div>
    <div class="tabel-responsive">
        <table class="table">
            <thead>
            <tr>
                <th class="text-center" scope="col">Назва</th>
                <th class="text-center" scope="col">Вид товару</th>
                <th class="text-center" scope="col">Slug</th>
                <th class="text-center" scope="col">Користувач</th>
                <th class="text-center" scope="col">Кількість товарів</th>
                <th class="text-center" scope="col">Змінено</th>
                <th class="text-center" scope="col">Створено</th>
                <th class="text-center" scope="col">Редагувати</th>
                <th class="text-center" scope="col">Видалити</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($product_categories as $product_category)
                <tr>
                    <th class="text-center" scope="row">{{ $product_category->name }}</th>
                    <td class="text-center">{{ $product_category->type->name }}</td>
                    <td class="text-center">{{ $product_category->slug }}</td>
                    <td class="text-center">{{ $product_category->user->name }}</td>
                    <td class="text-center">
                        <a href="{{ route('admin.products.productsListToCategory', $product_category) }}">
                            {{ count($product_category->products) }}
                        </a>
                    </td>
                    <td class="text-center">{{ $product_category->updated_at }}</td>
                    <td class="text-center">{{ $product_category->created_at }}</td>
                    <td class="text-center">
                        <a href="{{ route('admin.productCategories.edit', $product_category) }}"><i class="bi bi-pencil-fill"></i></a>
                    </td>
                    <td class="text-center">
                        <form class="text-center" action="{{ route('admin.productCategories.delete', $product_category) }}" method="POST"
                            onsubmit="if(!confirm('Видалити?')) return false">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn"><i class="bi bi-x-square text-danger"></i></button>
                        </form>

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
