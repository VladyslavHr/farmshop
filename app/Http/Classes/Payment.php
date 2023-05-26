<?php

namespace  App\Http\Classes;

use App\Contracts\PaymentInterface;
use App\Models\Order;
use Illuminate\Support\Facades\Http;

class Payment implements PaymentInterface
{


    public function test()
    {
        echo 'test!';
    }

    public function getPaymentLink(Order $order)
    {

        $items = [];

        foreach ($order->items as $orderItems) {
            $items[] = [
                "name"=> $orderItems->product_name,
                "qty"=> $orderItems->product_count,
                "sum"=> round($orderItems->product_price * 100 * $orderItems->product_count),
                "icon"=> "https://kartinkof.club/uploads/posts/2022-04/1649993997_1-kartinkof-club-p-sonya-kartinki-prikolnie-1.jpg",
                "unit"=> $orderItems->product->price_type,
            ];
        };

        $response = Http::withHeaders([
            'X-Token' => config('app.monobank_token'),
        ])->post('https://api.monobank.ua/api/merchant/invoice/create',
            [
                "amount"=> round($order->total * 100),
                "ccy"=> 980,
                "merchantPaymInfo"=> [
                    "reference"=> "84d0070ee4e44667b31371d8f8813947",
                    "destination"=> "Покупка щастя",
                    "basketOrder"=> $items,
                ],
                "redirectUrl"=> route('monobank.returnUrl'),
                // "webHookUrl"=> "https://wildfarm.com.ua/gopay-notification",
                "webHookUrl"=> route('monobank.webHook'),
                "validity"=> 3600,
                "paymentType"=> "debit",
            ]);

        $body = $response->json();



        // dd($body);
        $order->update([
            'transaction_id' => $body['invoiceId'],
        ]);

        // dd($response->getStatusCode());

        if ($response->getStatusCode() != 200) {
            throw new \Exception('Payment gateway error');
        }

        // dump($body);

        // $response->dump();
        return $body['pageUrl'];
    }

    public function checkSign()
    {
        $pubKeyBase64 = config('app.monobank_token');

        $xSignBase64 = request()->header('X-Sign');

        $message = request()->getContent();

        $signature = base64_decode($xSignBase64);
        $publicKey = openssl_get_publickey($pubKeyBase64);


        telegram_bot_message([
            'message' => $message,
            'signature' => $signature,
            'publicKey' => $publicKey,
        ]);

        $result = openssl_verify($message, $signature, $publicKey, OPENSSL_ALGO_SHA256);

        return $result === 1 ? "OK" : "NOT OK";
    }

    public function checkOrderStatus($transactionId)
    {

    }

    public function refund($transactionId, $sum = null)
    {

    }
}
