@extends('layouts.app')

@section('page-title', 'Оформлення замовлення')

@section('content')

<div class="container">
    <form action="{{ route('orders.store') }}" method="POST" enctype="multipart/form-data" class="row">
        @csrf
        {{-- <input type="hidden" value="{{ $product->id }}"> --}}
        @foreach ($products as $product)
        @endforeach
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

            <div class="form-check self-shipping-check pt-4">
                <input class="form-check-input self-shipping-input" type="checkbox" name="self_shipping" value="1" id="check_self_shipping" onclick="choose_self_shipping()">
                <label class="form-check-label" for="check_self_shipping">
                  Самовивіз
                </label>
              </div>
            <div class="self-shipping" >
                Самовивіз можливий кожень день з 8:00 до 18:00
                За адресою с.Соколово дн-району Дніпропетровської обл.
            </div>
            <div class="delivery-new-post-wrap" id="delivery_new_post_choose" >
                <div class="delivery-title d-flex py-5">
                    <h2>
                        Доставка з Нова Пошта
                    </h2>
                    <div class="ms-3 delivery-logo-newpost">
                        <img style="width: 100%" src="/logo/noa_posta_logo.svg.png" alt="Нова Пошта">
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-3">
                        <span class="small-titles-inputs d-block">Населенний пункт</span>
                        <input type="text" name="new_post_locality" value=" {{ old('new_post_locality') }}" class=" input-checkout @error ('new_post_locality') is-invalid @enderror">
                        <div class="invalid-feedback">
                            @error ('new_post_locality') {{$message}}@enderror
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <span class="small-titles-inputs d-block">№ відділення</span>
                        <input type="text" name="new_post_num" value=" {{ old('new_post_num') }}" class="input-checkout @error ('new_post_num') is-invalid @enderror" oninput="check_input_new_post()">
                        <div class="invalid-feedback">
                            @error ('new_post_num') {{$message}}@enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <span class="small-titles-inputs d-block">Адреса відділення</span>
                        <input type="text" name="new_post_adress" value=" {{ old('new_post_adress') }}" class=" input-checkout @error ('new_post_adress') is-invalid @enderror" oninput="check_input_new_post()">
                        <div class="invalid-feedback">
                            @error ('new_post_adress') {{$message}}@enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="delivery-ukr-post-wrap" id="delivery_ukr_post_choose">
                <div class="delivery-title d-flex py-5">
                    <h2>
                        Доставка з Укрпошта
                    </h2>
                    <div class="ms-3 delivery-logo-ukrpost">
                        <img style="width: 100%" src="/logo/ukrposta-icon.png" alt="Укрпошта">
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3">
                        <span class="small-titles-inputs d-block">Населенний пункт</span>
                        <input type="text" name="post_locality" value=" {{ old('post_locality') }}" class=" input-checkout @error ('post_locality') is-invalid @enderror">
                        <div class="invalid-feedback">
                            @error ('post_locality') {{$message}}@enderror
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <span class="small-titles-inputs d-block">№ відділення</span>
                        <input type="text" name="post_num" value=" {{ old('post_num') }}" class=" input-checkout @error ('post_num') is-invalid @enderror">
                        <div class="invalid-feedback">
                            @error ('post_num') {{$message}}@enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <span class="small-titles-inputs d-block">Адреса відділення</span>
                        <input type="text" name="post_adress" value=" {{ old('post_adress') }}" class=" input-checkout @error ('post_adress') is-invalid @enderror">
                        <div class="invalid-feedback">
                            @error ('post_adress') {{$message}}@enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="row pt-3">
                <div class="col-lg-12">
                    <span lass="small-titles-inputs d-block">Коментар</span>
                    <textarea class="text-chekout" name="order_note" id="" cols="30" rows="10"></textarea>
                </div>
            </div>

        </div>

        <div class="col-md-6">
            <h2>Ваше замовлення</h2>
            <div class="order-info-price-wrap">
                <div class="table-responsive">
                    <table class="table align-middle">
                    <thead>
                        <tr>
                            <th class="order-info-price-title-prod fs-4">Товар</th>
                            <th class="order-info-price-title-total fs-4">Сума</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        {{-- ...
                        </tr>
                        <tr class="align-bottom">
                        ...
                        </tr>
                        <tr> --}}
                        @foreach ($products as $product)
                            <td class="fs-5 ">{{ $product->name }} <strong class="ms-2">x {{ $product->cart_quantity }}</strong></td>
                            <td class="fs-5">{{ $product->price }} ₴</td>
                        @endforeach

                        {{-- <td class="align-top">This cell is aligned to the top.</td>
                        <td>...</td> --}}
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td class="fs-4">До сплати</td>
                            <td class="fs-4">{{ $total_sum_product }} ₴</td>
                        </tr>
                    </tfoot>
                    </table>
                </div>
                <div class="h3 text-center pb-2">Оберіть спосіб оплати</div>
                <ul class="payment-method-list">
                    <li class="payment-method-item">
                        <input class="form-check-input me-2 payment-method-bank" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked>
                        <label class="form-check-label" for="flexRadioDefault2">
                            Онлайн (Спдатаити онлайн банківською карткою)
                        </label>
                    </li>
                    <li class="payment-method-item">
                        <input class="form-check-input me-2 payment-method-cash" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                        <label class="form-check-label" for="flexRadioDefault1">
                            Готівкою (Сплатити готівкою при самовивезенні, або у відділенні пошти)
                        </label>
                    </li>
                </ul>
                <div class="row">
                    <div class="col-lg-12 fs-1 text-center">
                        <i class="me-2 fa-brands fa-apple-pay"></i>
                        <i class="me-2 fa-brands fa-google-pay"></i>
                        <i class="me-2 fa-brands fa-cc-visa"></i>
                        <i class="fa-brands fa-cc-mastercard"></i>
                    </div>
                    <div class="col-lg-12 text-center">
                        <button type="submit" class="btn send-form fs-4">Оформити замовлення</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

@endsection
