@extends('admin.layouts.adminapp')

@section('page-title', 'Створення промо коду')

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
    </div>
    <form class="mt-3" action="{{ route('admin.promoCode.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="mb-3 col-md-6">
                <label for="" class="form-label">Назва промо коду</label>
                <input name="name" value="{{ old('name') }}" type="text" class="form-control" id="">
                <span class="form-text">Будь ласка напишіть назву промо коду.(обов'язково)</span>
            </div>
            <div class="mb-3 col-md-6">
                <span class="form-text">Оберіть будь ласка тип промо коду.</span>
                <select class="form-select" name="type" >
                    <option value="percent">Відсоток</option>
                    <option value="value">Сума</option>
                </select>
                <span class="form-text">Будь ласка оберіть тип промо коду.(обов'язково)</span>
            </div>
            <div class="mb-3 col-md-6">
                <label for="" class="form-label">Знижка</label>
                <input type="num" name="discount" value="{{ old('discount') }}" class="form-control">
                <span class="form-text">Будь ласка напишіть знижку</span>
            </div>
            <div class="mb-3 col-md-4">
                <label for="" class="form-label">Статус промо коду</label>
                <select name="active" id="" class="form-select">
                    <option value="0">Не активний</option>
                    <option value="1">Активний</option>
                </select>
                <span class="form-text">Будь ласка напишіть статут промо коду (НЕ активний або активний).</span>
            </div>
        </div>
        <button type="submit" class="btn btn-primary col-md-1" >Створити</button>
    </form>
</div>

@endsection
