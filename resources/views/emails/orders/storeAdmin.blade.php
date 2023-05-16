<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="viewport" content="width=device-width">
    <meta name="color-scheme" content="light">
    <meta name="supported-color-schemes" content="light">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Нове замовлення!</title>
</head>
<style>
      body {
        font-family: DejaVu Sans, sans-serif;
        background: #fff;
    }
    .padding{
        padding: 5px;
    }
    .padding-l{
        padding: 15px;
    }
    .white{
        color: #fff;
    }
    .center{
        text-align: center;
    }
    .bold{
        font-weight: bold
    }
    .divider{
        border: 1px solid #000000;
        /* padding-top: 5px; */
        /* padding-bottom: 5px; */
        margin: 10px 0;
    }
    .me{
        margin-right: 10px
    }

    .tab-center{
        margin-left: auto;
        margin-right: auto;
    }
    .tab-padding{
        padding: 15px;
        text-align: center;
    }
</style>
<body>
    <header style="background: #222b33; padding-bottom: 15px; padding-top: 15px; margin-bottom: 15px">
        <div class="center white ">
            <a class="white" href="https://www.wildfarm.com.ua/">Wildfarm.com.ua</a>
        </div>
        <div class="center padding-l">
            <img src="logo/logoimg.png" alt="Wildfarm.com.ua" width="100px">
        </div>
        <h2 class="center white">Нове замовлення! ADMIN</h2>

    </header>

    <main style="padding: 10px 0;">
        <div class="center padding">Замовник: <span class="bold">{{$order->name}} </span> <span class="bold">{{ $order->last_name }}</span></div>
        <div class="center padding">Номер замовлення: <span class="bold">{{ $order->id }}</span></div>
        <div class="center padding">Дата замовлення: <span class="bold">{{ $order->created_at }}</span></div>

        @if ($order->self_shipping == 1)
        <div class="center padding"><span class="me">Спосіб доставки:</span><span><b>Самовивіз</b></span></div>
        @else
        <div class="center padding">Доставка Новою Поштою</div>
        <div class="center padding">{{ $order->new_post_city }}</div>
        <div class="center padding">{{ $order->new_post_num }}</div>
        <div class="center padding">{{ $order->new_post_adress }}</div>
        @endif

        <div class="divider"></div>

        {{-- <div class="center padding"> --}}
            <table class="table tab-center">
                <tr>
                    <th class="tab-padding">Назва</th>
                    <th class="tab-padding">Ціна</th>
                    <th class="tab-padding">Кількість</th>
                    <th class="tab-padding">Сума</th>
                </tr>
                @foreach ($order->items as $item)
                <tr >
                    <td class="tab-padding">{{ $item->product_name }}</td>
                    @if ($item->old_price != 0)
                        <td class="tab-padding">{{ $item->product_old_price }} ₴</td>
                    @else
                        <td class="tab-padding">{{ $item->product_price }} ₴</td>
                    @endif
                        <td class="tab-padding">{{ $item->product_count }}</div>
                    @if ($item->old_price != 0)
                        <td class="tab-padding">{{ $item->product_old_price * $item->product_count }} ₴</td>
                    @else
                        <td class="tab-padding">{{ $item->product_price * $item->product_count }} ₴</td>
                    @endif

                </tr>
                @endforeach
            </table>
        {{-- </div> --}}

        <div class="padding-l">
            @if ($order->payment_method == 'cash')
            <div class="center padding">
                <span class="me">Спосіб платежу:</span>
                <span><b>Готівка</b></span>
            </div>
            @else
                <div class="center padding">
                    <span class="me">Спосіб платежу:</span>
                    <span><b>Карткою онлайн</b></span>
                </div>
            @endif

            <div class="center padding">
                <span>Загальна кількість товарів:</span>
                <span><b>{{ $order->product_quantity }}</b></span>
            </div>
            <div class="center padding">
                <span>Загальна сума:</span>
                <span><b>{{ $order->total }} ₴</b></span>
            </div>
        </div>



    </main>

    <footer style="background: #222b33; padding-top: 25px; padding-bottom 25px; margin-top:15px;" >
        <div class="center white">
            <a class="white" href="https://www.wildfarm.com.ua/">Wildfarm.com.ua</a>
        </div>
        <div class="center padding-l">
            {{-- <img src="{{ $logo }}" alt="Wildfarm.com.ua" width="100px"> --}}
        </div>
        <div class="center white padding">
            Бажаємо вам всього найкращого! Ваша команда Wildfarm.com.ua.
        </div>
    </footer>

</body>
