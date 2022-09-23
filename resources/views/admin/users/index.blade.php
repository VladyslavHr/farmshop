@extends('admin.layouts.adminapp')

@section('page-title', 'Список користувачів')

@section('content')

<div class="container py-3">
    <div class="row py-3">
        <div class="col-md-2">
            <a class="btn " href="{{ route('admin.users.create') }}">
                <i class="bi bi-plus-lg me-2"></i>
                Створити
            </a>
        </div>
    </div>
    <table class="table">
        <thead>
          <tr>
            <th class="text-center" scope="col">Ім'я</th>
            <th class="text-center" scope="col">Фамілія</th>
            <th class="text-center" scope="col">Ел.пошта</th>
            <th class="text-center" scope="col">Телефон</th>
            <th class="text-center" scope="col">Змінено</th>
            <th class="text-center" scope="col">Створено</th>
            <th class="text-center" scope="col">Редагувати</th>
            <th class="text-center" scope="col">Видалити</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <th class="text-center" scope="row">{{ $user->name }}</th>
                <td class="text-center">{{ $user->last_name }}</td>
                <td class="text-center">{{ $user->email }}</td>
                <td class="text-center">{{ $user->phone }}</td>
                <td class="text-center">{{ $user->updated_at }}</td>
                <td class="text-center">{{ $user->created_at }}</td>
                <td class="text-center">
                    <a href="{{ route('admin.users.edit', $user) }}"><i class="bi bi-pencil-fill"></i></a>
                </td>
                <td class="text-center">
                    <form class="text-center" action="{{ route('admin.users.delete', $user) }}" method="POST"
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
