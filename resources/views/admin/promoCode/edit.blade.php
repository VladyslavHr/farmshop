@extends('admin.layouts.adminapp')

@section('page-title', 'Редагування промо коду')

@section('content')
@include('admin.layouts.blocks.errors')
<div class="container py-3">
    <div class="row py-3">
        <div class="col-md-2">
            <a class="btn " href="{{ route('admin.promoCode.index') }}">
                <i class="bi bi-arrow-left-square me-2"></i>
                Повернутись
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
    <form class="mt-3" action="{{ route('admin.promoCode.update', $promoCode) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="mb-3 col-md-6">
                <label for="" class="form-label">Назва промо коду</label>
                <input name="name" value="{{ $promoCode->name }}" type="text" class="form-control">
                <span class="form-text">Будь ласка напишіть назву промо коду.(обов'язково)</span>
            </div>
            <div class="mb-3 col-md-4">
                <label for="" class="form-label">Тип промо коду</label>
                <select name="type" id="" class="form-select">
                    <option value="percent" {{ $promoCode->status == 'percent' ? 'selected' : '' }}>Відсоток</option>
                    {{-- <option value="value" {{ $promoCode->status == 'value' ? 'selected' : '' }}>Сума</option> --}}
                </select>
                <span class="form-text">Будь ласка напишіть тип промо коду (відсотокб сума).</span>
            </div>
            <div class="mb-3 col-md-4">
                <label for="" class="form-label">Знижка</label>
                <input type="num" name="discount" value="{{ $promoCode->discount }}" class="form-control">
                <span class="form-text">Будь ласка напишіть знижку</span>
            </div>
            <div class="mb-3 col-md-4">
                <label for="" class="form-label">Статус товару</label>
                <select name="active" id="" class="form-select">
                    <option value="0" {{ $promoCode->active == 0 ? 'selected' : '' }}>Не активний</option>
                    <option value="1" {{ $promoCode->active == 1 ? 'selected' : '' }}>Активний</option>
                </select>
                <span class="form-text">Будь ласка виберіть статут промо коду (Активний або не активний).</span>
            </div>
            <div class="mb-3 col-md-4">
                <label for="" class="form-label">Дійсний до</label>
                <input type="date" name="end_term" value="{{ $promoCode->end_term ? $promoCode->end_term->format('Y-m-d') : '' }}" class="form-control">
                <span class="form-text">Будь ласка вкажіть кінець дії</span>
            </div>
        </div>
        <button type="submit" class="btn btn-primary col-md-1" >Змінити</button>
    </form>
</div>

@endsection
