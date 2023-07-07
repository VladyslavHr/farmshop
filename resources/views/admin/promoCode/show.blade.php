@extends('admin.layouts.adminapp')

@section('page-title', 'Інформація промо коду')

@section('content')

<div class="container py-3">
    <div class="row py-3">
        <div class="col-md-2">
            <a class="btn " href="{{ route('admin.promoCode.index') }}">
                <i class="bi bi-arrow-left-square me-2"></i>
                Повернутись
            </a>

        </div>
        <div class="col-md-2">
            <a class="btn " href="{{ route('admin.promoCode.edit', $promoCode) }}">
                <i class="bi bi-pencil me-2"></i>
                Редагувати
            </a>
        </div>
        <div class="col-md-2">
            <a class="btn " href="{{ route('admin.promoCode.create') }}">
                <i class="bi bi-plus-lg me-2"></i>
                Створити
            </a>
        </div>
        <div class="col-md-2">
            <form class="text-center" action="{{ route('admin.promoCode.delete', $promoCode) }}" method="POST"
            onsubmit="if(!confirm('Видалити?')) return false">
            @method('DELETE')
            @csrf
            <button type="submit" class="btn"><i class="bi bi-trash me-2"></i> Видалити</button>
        </form>
        </div>
    </div>
    <div class="row py-3">
        <div class="col-lg-3 py-3">
            <span>
                <strong>
                    Назва:
                </strong>
            </span>
            <span>
                {{ $promoCode->name }}
            </span>
        </div>
        <div class="col-lg-3 py-3">
            <span>
                <strong>
                    Тип:
                </strong>
            </span>
            @if ($promoCode->type == 'percent')
                <span>
                    Відсоток
                </span>
            @else
                <span>
                    Сума
                </span>
            @endif

        </div>
        <div class="col-lg-3 py-3">
            <span>
                <strong>
                    Знижка:
                </strong>
            </span>
            <span>
                {{ $promoCode->discount }}
                @if ($promoCode->type == 'percent')
                    <span>
                        %
                    </span>
                @else
                    <span>
                        ₴
                    </span>
                @endif
            </span>
        </div>
        <div class="col-lg-3 py-3">
            <span>
                <strong>
                    Статус:
                </strong>
            </span>
            @if ($promoCode->active === 0)
                <span>Не активний</span>
            @elseif ($promoCode->active === 1)
                <span>Активний</span>
            @endif
        </div>
        <div class="col-lg-3 py-3">
            <span>
                <strong>
                    Придатен до:
                </strong>
            </span>
            <span>
                @if ($promoCode->term_date)
                    {{ $promoCode->term_date }}
                @else
                    Необмежений
                @endif
                {{-- {{ $promoCode->end_term ? $promoCode->end_term->format('Y-m-d') : '' }} --}}
            </span>
        </div>
    </div>
</div>

@endsection
