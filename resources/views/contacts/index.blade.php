@extends('layouts.app')

@section('content')
{!! RecaptchaV3::initJs() !!}
{{-- <div class="bg-image"></div> --}}
<div class="main-bg-image"></div>

<div class="container py-5">
    <div class="row">
        <div class="col-md-6">
            <h1>Контактна інформація</h1>
            {{-- <div class="contact-title">Lodní doprava Slapy</div> --}}
            <h2 class="py-3 contact-firm-title" >Wildfarm.com.ua</h2>
            <div class="contac-info">
                <div class="contact-el">
                    <span>
                        <strong>
                            Адреса:
                        </strong>
                    </span>
                    <span>
                        с. Соколово, вул. Гагаріна 18, Новомосковьский район, Дніпропетровська область.
                    </span>
                </div>
                <div class="contact-el">
                    <span>
                        <strong>
                            Телефон:
                        </strong>
                    </span>
                    <span>
                        <a href="tel: +380683382017"> +380 (68) 338 20 17</a>
                    </span>
                </div>
                <div class="contact-el">
                    <span>
                        <strong>
                            Електронна адреса:
                        </strong>
                    </span>
                    <span>
                        info@wildfarm.com.ua
                    </span>
                </div>
            </div>
            {{-- <div>Provozovatel</div>
            <div class="contac-info">
                <div class="contact-el">
                    <span>
                        <strong>
                            QUARTER s.r.o.
                        </strong>
                    </span>
                </div>
                <div class="contact-el">
                    <span>
                        <strong>
                            Adresa:
                        </strong>
                    </span>
                    <span>
                        Nad Akcízem 1033/3 182 00 Praha 8
                    </span>
                </div>
            </div> --}}
        </div>
        <div class="col-md-6 ">
            <form action="{{ route('contacts.store') }}" method="POST"  enctype="multipart/form-data">
                @csrf
                <h2 class="mb-4">Зв'яжіться з нами</h2>
                <div class="contact-inputs row mb-4">
                    <div class="contact-input-email col-md-4">
                        <span class="small-titles-inputs">Ваша електронна адреса</span>
                        <input name="email" value="{{ old('email') }}" class="form-control input-contact @error ('email') is-invalid @enderror" type="email">
                        <div class="invalid-feedback">
                            @error ('email') {{$message}}@enderror
                        </div>
                    </div>
                    <div class="contact-input-name col-md-4">
                        <span class="small-titles-inputs">Ваше ім'я</span>
                        <input name="name" value="{{ old('name') }}" class="form-control input-contact @error ('name') is-invalid @enderror" type="text">
                        <div class="invalid-feedback">
                            @error ('name') {{$message}}@enderror
                        </div>
                    </div>
                    <div class="contact-input-phone col-md-4">
                        <span class="small-titles-inputs">Ваш номер телефону</span>
                        <input type="tel" name="phone" value=" {{ old('phone') }}" class="form-control input-contact @error ('phone') is-invalid @enderror">
                        <div class="invalid-feedback">
                            @error ('phone') {{$message}}@enderror
                        </div>
                    </div>
                </div>
                <div class="contact-text mb-4">
                    <span class="small-titles-inputs">Ваше повідомлення</span>
                    <textarea class="form-control textarea-contact @error ('text') is-invalid @enderror" name="text" id="" cols="50" rows="10">{{ old('text') }}</textarea>
                    <div class="invalid-feedback">
                        @error ('text') {{$message}}@enderror
                    </div>
                </div>
                <div class="form-group{{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}">
                    <div class="col-lg-6">
                        {!! RecaptchaV3::field('contact') !!}
                        @if ($errors->has('g-recaptcha-response'))
                            <span class="help-block">
                                <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="contact-send-form text-end">
                    <button type="submit" class="btn send-form">
                        Відправити
                        <i class="bi bi-send-fill"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="container-wrap-contact-firma">
    <div class="container">
        <div class="row">
            <div class="col-md-6 contact-firma-left">
                <h2>
                    Платіжна інформація
                </h2>
                <h3>
                    Wildfarm.com.ua
                </h3>
            </div>
            <div class="col-md-6 contact-firma-right">
                <div class="cont-firma">
                    <strong>
                        ФОП:
                    </strong>
                        Гребеннікова Ганна Володимирівна
                </div>
                <div class="cont-firma">
                    <strong>
                        Адреса:
                    </strong>
                        с. Соколово, вул. Гагаріна 18, Новомосковьский район, Дніпропетровська область.
                </div>
                {{-- <div class="cont-firma">
                    <strong>
                        IČ:
                    </strong>
                        62577794
                </div>
                <div class="cont-firma">
                    <strong>
                        DIČ:
                    </strong>
                        CZ62577794
                </div> --}}
            </div>
        </div>
    </div>
</div>




@endsection
