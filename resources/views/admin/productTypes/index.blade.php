@extends('admin.layouts.adminapp')

@section('page-title', 'Список видів')

@section('content')

<div class="container py-3">
    <div class="row py-3">
        <div class="col-md-2">
            <a class="btn " href="{{ route('admin.productTypes.create') }}">
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
                <th class="text-center" scope="col">Slug</th>
                <th class="text-center" scope="col">Користувач</th>
                <th class="text-center" scope="col">Кількість категорій</th>
                <th class="text-center" scope="col">Змінено</th>
                <th class="text-center" scope="col">Створено</th>
                <th class="text-center" scope="col">Редагувати</th>
                <th class="text-center" scope="col">Видалити</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($product_types as $product_type)
                <tr>
                    <th class="text-center" scope="row">{{ $product_type->name }}</th>
                    <td class="text-center">{{ $product_type->slug }}</td>
                    <td class="text-center">{{ $product_type->user->name }}</td>
                    <td class="text-center">
                        <a href="{{ route('admin.productCategories.categoriesListToType', $product_type) }}">
                            {{ count($product_type->categories) }}
                        </a>
                    </td>
                    <td class="text-center">{{ $product_type->updated_at }}</td>
                    <td class="text-center">{{ $product_type->created_at }}</td>
                    <td class="text-center">
                        <a href="{{ route('admin.productTypes.edit', $product_type) }}"><i class="bi bi-pencil-fill"></i></a>
                    </td>
                    <td class="text-center">
                        <form class="text-center" action="{{ route('admin.productTypes.delete', $product_type) }}" method="POST"
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
