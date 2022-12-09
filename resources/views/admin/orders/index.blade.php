@extends('admin.layouts.adminapp')

@section('page-title', 'Список замовлень')

@section('content')

<div class="container py-3">
    <div class="row py-3">
        <div class="col-md-2">
            {{-- <a class="btn " href="{{ route('admin.orders.create') }}">
                <i class="bi bi-plus-lg me-2"></i>
                Створити
            </a> --}}
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
                <td class="text-center">Сплачено</td>
                <td class="text-center">Відправлено</td>
                <td class="text-center">
                    <a href="{{ route('admin.orders.show', $order) }}">
                        <i class="bi bi-eye"></i>
                    </a>
                </td>
                <td class="text-center">{{ $order->updated_at->format('Y-m-d H:i') }}</td>
                <td class="text-center">{{ $order->created_at->format('Y-m-d H:i') }}</td>
              </tr>
            @endforeach
        </tbody>
      </table>
    {{ $orders->links() }}
    </div>
</div>

@endsection
