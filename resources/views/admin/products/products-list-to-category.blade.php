@extends('admin.layouts.adminapp')

@section('page-title', 'Список товарів у категорії')
{{-- @section('description', $service->seo_description) --}}

@section('content')

<div class="container py-3">
    <div class="row py-3">
        <div class="col-md-2">
            <a class="btn " href="{{ route('admin.productCategories.index') }}">
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
    </div>
    <table class="table">
        <thead>
          <tr>
            <th class="text-center" scope="col">Назва</th>
            <th class="text-center" scope="col">Користувач</th>
            <th class="text-center" scope="col">Ціна</th>
            <th class="text-center" scope="col">Ціна перед знижкою</th>
            <th class="text-center" scope="col">Кількість</th>
            <th class="text-center" scope="col">Статус</th>
            <th class="text-center" scope="col">Нотатки</th>
            <th class="text-center" scope="col">Перегляд</th>
            <th class="text-center" scope="col">Змінено</th>
            <th class="text-center" scope="col">Створено</th>
            <th class="text-center" scope="col">Редагувати</th>
            <th class="text-center" scope="col">Видалити</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($product_category->products as $product)
            <tr>
                <th class="text-center" scope="row">{{ $product->name }}</th>
                <td class="text-center">{{ $product->user->name }}</td>
                <td class="text-center">{{ $product->price }}</td>
                <td class="text-center">{{ $product->old_price }}</td>
                <td class="text-center">{{ $product->quantity }}</td>
                @if ($product->status === 'in_stock')
                <td class="text-center">В наявності</td>
                @elseif ($product->status === 'out_of_stock')
                <td class="text-center">Немає в наявності</td>
                @elseif ($product->status === 'for_order')
                <td class="text-center">Під замовлення</td>
                @endif
                <td class="text-center">{{ count($product->notes) }}</td>
                <td class="text-center">
                    <a href="{{ route('admin.products.show', $product) }}">
                        <i class="bi bi-eye"></i>
                    </a>
                </td>
                <td class="text-center">{{ $product->updated_at->format('Y-m-d H:i') }}</td>
                <td class="text-center">{{ $product->created_at->format('Y-m-d H:i') }}</td>
                <td class="text-center">
                    <a href="{{ route('admin.products.edit', $product) }}"><i class="bi bi-pencil-fill"></i></a>
                </td>
                <td class="text-center">
                    <form class="text-center" action="{{ route('admin.products.delete', $product) }}" method="POST"
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

@endsection
