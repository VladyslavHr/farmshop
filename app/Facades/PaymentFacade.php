<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class PaymentFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'payment'; // Имя сервиса, который вы хотите представить через фасад
    }

    public static function processPayment($amount, $data)
    {
        // Ваш код обработки платежа
    }

    // Другие методы для работы с платежами
}
