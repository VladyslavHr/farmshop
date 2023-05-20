<?php

namespace App\Contracts;

use App\Models\Order;

interface PaymentInterface
{
    public function getPaymentLink(Order $order);
    public function checkOrderStatus($transactionId);
    public function refund($transactionId, $sum = null);

}
