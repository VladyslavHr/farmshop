@extends('admin.layouts.adminapp')

@section('page-title', 'Список замовлень')

@section('content')

<div class="container py-3">
    <div class="row py-3">
        <div class="col-md-2">
            <select class="form-select" onchange="location.href = this.value">
                @foreach ($sortingOptions as $value)
                <option {{ $value['val'] === $sortingParams ? 'selected' : ''}}
                    value="{{ $value['val'] }}">{{ $value['lable'] }}
                </option>
                @endforeach
            </select>
            {{-- <a class="btn " href="{{ route('admin.orders.create') }}">
                <i class="bi bi-plus-lg me-2"></i>
                Створити
            </a> --}}
        </div>
        <div class="col-md-6">
            {{ $orders->withQueryString()->links() }}
        </div>
    </div>

    <div class="tabel-responsive">
        <table class="table">
        <thead>
          <tr>
            <th class="text-center" scope="col">Номер</th>
            <th class="text-center" scope="col">Замовник</th>
            <th class="text-center" scope="col">Емеіл</th>
            <th class="text-center" scope="col">Телефон</th>
            <th class="text-center" scope="col">Сума</th>
            <th class="text-center" scope="col">К-ть позицій</th>
            <th class="text-center" scope="col">Самовивіз</th>
            <th class="text-center" scope="col">Статус платежа</th>
            <th class="text-center" scope="col">Статус замовлення</th>
            <th class="text-center" scope="col">Перегляд</th>
            <th class="text-center" scope="col">Змінено</th>
            <th class="text-center" scope="col">Створено</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
            <tr>
                <th class="text-center" scope="row">{{ $order->id }}</th>
                <td class="text-center">{{ $order->name }} {{ $order->last_name }}</td>
                <td class="text-center">{{ $order->email }}</td>
                <td class="text-center">{{ $order->phone }}</td>
                <td class="text-center">{{ $order->total }}</td>
                <td class="text-center">{{ $order->product_quantity }}</td>
                @if ($order->self_shipping === 1)
                <td class="text-center">Так</td>
                @else
                <td class="text-center">Ні</td>
                @endif
                @if ($order->payment_status === 'created')
                  <td class="text-center text-secondary">Створено <i class="bi bi-hourglass-split"></i> </td>
                @elseif ($order->payment_status === 'pending')
                  <td class="text-center text-secondary">Опрацьовується <i class="bi bi-hourglass-split"></i> </td>
                @elseif ($order->payment_status === 'paid')
                  <td class="text-center text-success">Сплачено <i class="bi bi-cash-coin"></i> </td>
                @elseif ($order->payment_status === 'canceled')
                  <td class="text-center text-danger">Відмінено <i class="bi bi-x"></i> </td>
                @elseif ($order->payment_status === 'refounded')
                  <td class="text-center text-warning">Повернуто <i class="bi bi-arrow-repeat"></i></td>
                @elseif ($order->payment_status === 'cash')
                  <td class="text-center text-info">Готівка <i class="bi bi-cash-coin"></i></td>
                @endif
                @if ($order->delivery_status === 'preparing')
                  <td class="text-center text-secondary">Збирається <i class="bi bi-box-seam"></i></td>
                @elseif ($order->delivery_status === 'collected')
                  <td class="text-center text-success">Зібрано <i class="bi bi-box-seam"></i></td>
                @elseif ($order->delivery_status === 'delivered')
                  <td class="text-center text-success">Відправлено <i class="bi bi-truck"></i></td>
                @elseif ($order->delivery_status === 'canceled')
                    <td class="text-center text-danger">Cкасовано <i class="bi bi-x-lg"></i> </td>
                @elseif ($order->delivery_status === 'returned')
                  <td class="text-center text-danger">Повернуто <i class="bi bi-arrow-repeat"></i></td>
                @endif
                <td class="text-center">
                    <a href="{{ route('admin.orders.show', $order) }}">
                        <i class="bi bi-eye"></i>
                    </a>
                </td>
                <td class="text-center">{{ $order->updated_at->format('m-d') }}</td>
                <td class="text-center">{{ $order->created_at->format('Y-m-d') }}</td>
              </tr>
            @endforeach
        </tbody>
      </table>
    {{ $orders->withQueryString()->links() }}
    </div>
</div>

@endsection
