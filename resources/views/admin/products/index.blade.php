@extends('admin.layouts.adminapp')

@section('page-title', 'Список товарів')

@section('content')

<div class="container py-3">
    <table class="table">
        <thead>
          <tr>
            <th class="text-center" scope="col">Назва</th>
            {{-- <th class="text-center" scope="col">Вид товару</th> --}}
            <th class="text-center" scope="col">Slug</th>
            <th class="text-center" scope="col">Користувач</th>
            <th class="text-center" scope="col">Змінено</th>
            <th class="text-center" scope="col">Створено</th>
            <th class="text-center" scope="col">Редагувати</th>
            <th class="text-center" scope="col">Видалити</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
            <tr>
                <th class="text-center" scope="row">{{ $product->name }}</th>
                {{-- <td class="text-center">{{ $product->type->name }}</td> --}}
                <td class="text-center">{{ $product->slug }}</td>
                <td class="text-center">{{ $product->user->name }}</td>
                <td class="text-center">{{ $product->updated_at }}</td>
                <td class="text-center">{{ $product->created_at }}</td>
                <td class="text-center">
                    <a href="{{ route('admin.productCategories.edit', $product) }}"><i class="bi bi-pencil-fill"></i></a>
                </td>
                <td class="text-center">
                    <form class="text-center" action="{{ route('admin.productCategories.delete', $product) }}" method="POST"
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
