@extends('admin.layouts.adminapp')

@section('page-title', 'Список промо кодів')

@section('content')

<div class="container py-3">
    <div class="row py-3">
        <div class="col-md-2">
            <a class="btn " href="{{ route('admin.promoCode.create') }}">
                <i class="bi bi-plus-lg me-2"></i>
                Створити
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-2">
            {{-- <select class="form-select" onchange="location.href = this.value">
                @foreach ($sortingOptions as $value)
                <option {{ $value['val'] === $sortingParams ? 'selected' : ''}}
                    value="{{ $value['val'] }}">{{ $value['lable'] }}
                </option>
                @endforeach
            </select> --}}
            {{-- <a class="btn " href="{{ route('admin.orders.create') }}">
                <i class="bi bi-plus-lg me-2"></i>
                Створити
            </a> --}}
        </div>
        <div class="col-lg-10">
            {{ $promoCodes->links() }}
        </div>
    </div>
    <div class="tabel-responsive">
        <table class="table">
        <thead>
          <tr>
            <th class="text-center" scope="col">Назва</th>
            <th class="text-center" scope="col">Користувач</th>
            <th class="text-center" scope="col">Тип</th>
            <th class="text-center" scope="col">Знижка</th>
            <th class="text-center" scope="col">Статус</th>
            <th class="text-center" scope="col">Перегляд</th>
            <th class="text-center" scope="col">Змінено</th>
            <th class="text-center" scope="col">Створено</th>
            <th class="text-center" scope="col">Редагувати</th>
            <th class="text-center" scope="col">Видалити</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($promoCodes as $promo)
            <tr>
                <th class="text-center" scope="row">{{ $promo->name }}</th>
                <td class="text-center">{{ $promo->user->name }}</td>
                @if ($promo->type === 'percent')
                    <td class="text-center">Відсоток</td>
                @elseif ($promo->type === 'value')
                    <td class="text-center">Сума</td>
                @endif
                <td class="text-center">{{ $promo->discount }}</td>
                @if ($promo->active === 0)
                    <td class="text-center">Не активний</td>
                @elseif ($promo->active === 1)
                    <td class="text-center">Активний</td>
                @endif
                <td class="text-center">
                    <a href="{{ route('admin.promoCode.show', $promo) }}">
                        <i class="bi bi-eye"></i>
                    </a>
                </td>
                <td class="text-center">{{ $promo->updated_at->format('Y-m-d H:i') }}</td>
                <td class="text-center">{{ $promo->created_at->format('Y-m-d H:i') }}</td>
                <td class="text-center">
                    <a href="{{ route('admin.promoCode.edit', $promo) }}"><i class="bi bi-pencil-fill"></i></a>
                </td>
                <td class="text-center">
                    <form class="text-center" action="{{ route('admin.promoCode.delete', $promo->id) }}" method="POST"
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
    <div class="row">
        <div class="col-lg-12">
            {{ $promoCodes->links() }}
        </div>
    </div>
</div>

@endsection
