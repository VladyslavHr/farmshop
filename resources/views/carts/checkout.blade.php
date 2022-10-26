@extends('layouts.app')

@section('page-title', 'Оформлення замовлення')

@section('content')

<div class="container">
    <form action="" class="row">
        <div class="col-md-6">
            <h2 class="pt-2">Платіжні реквізити</h2>
            <div class="row">
                <div class="col-lg-6">
                    <span class="small-titles-inputs d-block">Ім'я</span>
                    <input type="text" name="name" value=" {{ old('name') }}" class=" input-checkout @error ('name') is-invalid @enderror">
                    <div class="invalid-feedback">
                        @error ('name') {{$message}}@enderror
                    </div>
                </div>
                <div class="col-lg-6">
                    <span class="small-titles-inputs d-block">Прізвище</span>
                    <input type="text" name="last_name" value=" {{ old('last_name') }}" class=" input-checkout @error ('last_name') is-invalid @enderror">
                    <div class="invalid-feedback">
                        @error ('last_name') {{$message}}@enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <span class="small-titles-inputs d-block">Електронна пошта</span>
                    <input type="email" name="email" value=" {{ old('email') }}" class=" input-checkout @error ('email') is-invalid @enderror">
                    <div class="invalid-feedback">
                        @error ('email') {{$message}}@enderror
                    </div>
                </div>
                <div class="col-lg-6">
                    <span class="small-titles-inputs d-block">Мобільний телефон</span>
                    <input type="tel" name="phone" value=" {{ old('phone') }}" class=" input-checkout @error ('phone') is-invalid @enderror">
                    <div class="invalid-feedback">
                        @error ('phone') {{$message}}@enderror
                    </div>
                </div>
            </div>

            <div class="form-check self-shipping-check">
                <input class="form-check-input self-shipping-input" type="checkbox" value="" id="flexCheckDefault">
                <label class="form-check-label" for="flexCheckDefault">
                  Самовивіз
                </label>
              </div>
            <div class="self-shipping">
                Самовивіз можливий кожень день з 8:00 до 18:00
                За адресою с.Соколово дн-району Дніпропетровської обл.
            </div>

            <h2 class="pt-2">Доставка з Нова Пошта</h2>

            <div class="row">
                <div class="col-lg-4">
                    <span class="small-titles-inputs d-block">Номер відділення</span>
                    <input type="text" name="new_post_num" value=" {{ old('new_post_num') }}" class=" input-checkout @error ('new_post_num') is-invalid @enderror">
                    <div class="invalid-feedback">
                        @error ('new_post_num') {{$message}}@enderror
                    </div>
                </div>
                <div class="col-lg-8">
                    <span class="small-titles-inputs d-block">Адреса відділення</span>
                    <input type="text" name="new_post_adress" value=" {{ old('new_post_adress') }}" class=" input-checkout @error ('new_post_adress') is-invalid @enderror">
                    <div class="invalid-feedback">
                        @error ('new_post_adress') {{$message}}@enderror
                    </div>
                </div>
            </div>
            <h2 class="pt-2">Доставка з Укрпошта</h2>

            <div class="row">
                <div class="col-lg-4">
                    <span class="small-titles-inputs d-block">Номер відділення</span>
                    <input type="text" name="post_num" value=" {{ old('post_num') }}" class=" input-checkout @error ('post_num') is-invalid @enderror">
                    <div class="invalid-feedback">
                        @error ('post_num') {{$message}}@enderror
                    </div>
                </div>
                <div class="col-lg-8">
                    <span class="small-titles-inputs d-block">Адреса відділення</span>
                    <input type="text" name="post_adress" value=" {{ old('post_adress') }}" class=" input-checkout @error ('post_adress') is-invalid @enderror">
                    <div class="invalid-feedback">
                        @error ('post_adress') {{$message}}@enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <span lass="small-titles-inputs d-block">Коментар</span>
                    <textarea class="text-chekout" name="order_note" id="" cols="30" rows="10"></textarea>
                </div>

            </div>

        </div>


        <div class="col-md-6">
            <h2>Ваше замовлення</h2>

            <div class="row">
                <div class="col-lg-6">Товар</div>
                <div class="col-lg-6">Сума</div>
            </div>

            <div class="row">
                @foreach ($products as $product)
                    <div class="col-lg-6">
                        {{ $product->name }} x {{ $cart[$product->id] }}
                    </div>
                    <div class="col-lg-6">
                        {{ $product->price }}
                    </div>
                @endforeach

            </div>

            <div class="row">
                <div class="col-lg-6">До салти</div>
                <div class="col-lg-6">1000 ₴</div>
            </div>

            <div class="row">
                <div class="col-lg-12 text-center">
                    <button type="submit" class="btn btn-primary">Оформити замовлення</button>
                </div>
            </div>
        </div>

    </form>
</div>

@endsection
