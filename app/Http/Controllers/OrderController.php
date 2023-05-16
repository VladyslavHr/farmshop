<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreOrderRequest;
use App\Models\{Order,OrderItem,User};
use App\Http\Requests\{CartStoreRequest};
use App\Http\Classes\Cart;
use Illuminate\Support\Facades\Notification;
use WayForPay\SDK\Collection\ProductCollection;
use WayForPay\SDK\Credential\AccountSecretTestCredential;
use WayForPay\SDK\Credential\AccountSecretCredential;
use WayForPay\SDK\Domain\Client;
use WayForPay\SDK\Domain\Product;
use WayForPay\SDK\Wizard\PurchaseWizard;
use WayForPay\SDK\Domain\MerchantTypes;
use WayForPay\SDK\Exception\WayForPaySDKException;
use WayForPay\SDK\Handler\ServiceUrlHandler;
use App\Notifications\{OrderClientStoreSend,OrderClientStoreAdmin};
use Mail;

class OrderController extends Controller
{
    public function index()
    {
        return view('orders.index', [
            'products' => Cart::getProducts(),
            'total_sum_product' => Cart::getTotalSum(),
        ]);
    }


    public function store(StoreOrderRequest $request)
    {
        $total_sum_product = Cart::getTotalSum();
        $product_count = Cart::getTotalCount();

        $data = $request->validated();
        $data['total'] =  $total_sum_product;
        $data['product_quantity'] =  $product_count;
        $data['payment_status'] = Order::STATUS_PENDING;
        $data['delivery_status'] = Order::STATUS_PREPARING;
        // $data['user_id'] = auth()->user()->id;

        $order = Order::create($data);

        $products = Cart::getProducts();

        foreach ($products as $product) {
            $order_item['order_id'] = $order->id;
            $order_item['product_id'] = $product->id;
            $order_item['product_name'] = $product->name;
            $order_item['product_price'] = $product->price;
            $order_item['product_old_price'] = $product->old_price;
            $order_item['product_count'] = $product->cart_quantity;

            $ordered = OrderItem::create($order_item);

        }

        // if (condition) {
        //     # code...
        // }
        // Check payment method

        if ($order->payment_method == 'card') {
            return $this->checkout($data, $order);
        }else{
            // $this->updateOrderStatus($order->id);
            // dd($order->order_items());
            foreach ($order->items as $order_item) {
                $order_item->product->update([
                    'quantity' => $order_item->product->quantity - $order_item->product_count
                ]);
                if ($order_item->product->quantity <= 0) {
                    $order_item->product->update([
                        'status' => 'out_of_stock'
                    ]);
                }
            }
            $order->notify(new OrderClientStoreSend($order));

            $admins = User::get();
            // Notification::send($users, new InvoicePaid($invoice));
            Notification::send($admins, new OrderClientStoreAdmin($order));

            session()->forget('cart');
            return redirect()->route('orders.thanks', $order->id);
        }

        // return $this->checkout($data, $order);

        // return redirect()->route('orders.thanks');
    }

    public function checkoutMono()
    {

        $pubKeyBase64 = 'uapzSJx4sRI8H2Z37MvqDxXDOK8y50zwD_FxnQHeOTks';

        $xSignBase64 = 'uapzSJx4sRI8H2Z37MvqDxXDOK8y50zwD_FxnQHeOTks';

        $message = '{
            "invoiceId": "p2_9ZgpZVsl3",
            "status": "created",
            "failureReason": "string",
            "amount": 4200,
            "ccy": 980,
            "finalAmount": 4200,
            "createdDate": "2019-08-24T14:15:22Z",
            "modifiedDate": "2019-08-24T14:15:22Z",
            "reference": "84d0070ee4e44667b31371d8f8813947",
            "cancelList": [
              {
                "status": "processing",
                "amount": 4200,
                "ccy": 980,
                "createdDate": "2019-08-24T14:15:22Z",
                "modifiedDate": "2019-08-24T14:15:22Z",
                "approvalCode": "662476",
                "rrn": "060189181768",
                "extRef": "635ace02599849e981b2cd7a65f417fe"
              }
            ]
          }';

        // "amount": 4200,
        // "ccy": 980,
        // "merchantPaymInfo": {
        // "reference": "84d0070ee4e44667b31371d8f8813947",
        // "destination": "Покупка щастя",
        // "basketOrder": []
        // },
        // "redirectUrl": "https://example.com/your/website/result/page",
        // "webHookUrl": "https://example.com/mono/acquiring/webhook/maybesomegibberishuniquestringbutnotnecessarily",
        // "validity": 3600,
        // "paymentType": "debit",
        // "qrId": "XJ_DiM4rTd5V",
        // "saveCardData": {
        // "saveCard": true,
        // "walletId": "69f780d841a0434aa535b08821f4822c"
        // }








        $signature = base64_decode($xSignBase64);
        $publicKey = openssl_get_publickey(base64_decode($pubKeyBase64));

        $result = openssl_verify($message, $signature, $publicKey, OPENSSL_ALGO_SHA256);

        echo $result === 1 ? "OK" : "NOT OK";
    }


    public function monoPay()
    {

        // {
        //     "amount": 4200,
        //     "ccy": 980,
        //     "merchantPaymInfo": {
        //     "reference": "84d0070ee4e44667b31371d8f8813947",
        //     "destination": "Покупка щастя",
        //     "basketOrder": [$order]
        //     },
        //     "redirectUrl": "https://example.com/your/website/result/page",
        //     "webHookUrl": "https://example.com/mono/acquiring/webhook/maybesomegibberishuniquestringbutnotnecessarily",
        //     "validity": 3600,
        //     "paymentType": "debit",
        //     "qrId": "XJ_DiM4rTd5V",
        //     "saveCardData": {
        //     "saveCard": true,
        //     "walletId": "69f780d841a0434aa535b08821f4822c"
        //     }
        //     }
    }

    public function checkout($data, $order)
    {
        // dd($data);
        // Use test credential or yours
        // $credential = new AccountSecretTestCredential();
        $credential = new AccountSecretCredential(config('app.merchant_id'), config('app.merchant_secret'));

        $form = PurchaseWizard::get($credential)
            ->setOrderReference($order->order_reference)
            ->setAmount($data['total'])
            ->setCurrency('UAH')
            ->setOrderDate(new \DateTime())
            ->setMerchantDomainName('www.wildfarm.com.ua')
        //    ->setMerchantTransactionType(MerchantTypes::TRANSACTION_AUTO)
        //    ->setMerchantTransactionType(MerchantTypes::TRANSACTION_AUTH) //  hold
            ->setClient(new Client(
                $data['name'],
                $data['last_name'],
                $data['email'],
                $data['phone'],
            ))
            ->setProducts(new ProductCollection(array(
                new Product('test', 0.01, 1)
            )))
            ->setReturnUrl(route('wayForPay.returnUrl'))
            ->setServiceUrl(route('wayForPay.serviceUrl'))
            ->getForm()
            ->getAsString();

        return view('checkouts.index', [
            'credential' => $credential,
            'form' => $form,
        ]);
    }

    public function refund(Request $request)
    {
        $order = Order::findOrFail($request->order_id);
        // Use test credential or yours
        // $credential = new AccountSecretTestCredential();
        $credential = new AccountSecretCredential(config('app.merchant_id'), config('app.merchant_secret'));

        $response = RefundWizard::get($credential)
            ->setOrderReference($order->order_reference)
            ->setAmount($order->total)
            ->setCurrency('UAH')
            ->setComment('Refund' . $order->order_reference)
            ->getRequest()
            ->send();


            echo 'Reason Code: ' . $response->getReason()->getCode() . PHP_EOL;
            echo 'Order status: ' . $response->getTransactionStatus() . PHP_EOL;
    }

    public function thanks($order)
    {

        $order = Order::where('id', $order)->first();

        return view('orders.thanks',[
            'order' => $order,
        ]);
    }
    public function wayForPayReturnUrl()
    {
        // Use test credential or yours
        // $credential = new AccountSecretTestCredential();
        $credential = new AccountSecretCredential(config('app.merchant_id'), config('app.merchant_secret'));


        try {
            $handler = new ServiceUrlHandler($credential);
            $response = $handler->parseRequestFromGlobals();

            if ($response->getReason()->isOK()) {
                // dump(request()->all());
                // dump(request('orderReference'));
                // $orderReference =  $response['orderReference'];
                session()->forget('cart');
                $message = 'Tnahk you';
                $isSuccess = true;
            } else {
                $message = $response->getReason()->getMessage();
                telegram_bot_message($message);
                $isSuccess = false;

                // echo $response->getOrderReference();
                // codeError = getOrderReference();
                // echo "Error: " . $response->getReason()->getMessage();
            }
        } catch (WayForPaySDKException $e) {
            dd("WayForPay SDK exception: " . $e->getMessage());
        }
        // public_path('test.json');
        // file_put_contents(public_path('test.json'), json_encode($_REQUEST, 128));

        $order = explode('-', $_REQUEST['orderReference']);

        $order = $order[1];

        $order = Order::findOrFail($order);
        // dd($order);

        return view('orders.thanks', [
            'order' => $order,
            'message' => $message,
            'isSuccess' => $isSuccess,
        ]);
    }
    public function wayForPayServiceUrl()
    {
        // Use test credential or yours
        // $credential = new AccountSecretTestCredential();
        $credential = new AccountSecretCredential(config('app.merchant_id'), config('app.merchant_secret'));

        try {
            $handler = new ServiceUrlHandler($credential);
            $response = $handler->parseRequestFromPostRaw();

            $return = $handler->getSuccessResponse($response->getTransaction());
            echo $return;
            // telegram_bot_message('serviceURL $return ' . $return );
            file_put_contents(public_path('test/serviceUrlData_success.json'), date("H:i").PHP_EOL.$return);

            $json = file_get_contents('php://input');

            $returnObject = json_decode($json);

            telegram_bot_message($returnObject );

            $orderId = $returnObject->orderReference;

            $orderId = explode('-', $orderId);

            $orderId = $orderId[1];

            if ($returnObject->reasonCode == 1100) {
                $this->updateOrderStatus($orderId, Order::STATUS_PAID);
                $this->notifySuccessOrder($orderId);
            }elseif ($returnObject->reasonCode != 1134){
                $this->updateOrderStatus($orderId, Order::STATUS_CANCELED);
            }

            // telegram_bot_message('serviceURL $orderId ' . $orderId );

        } catch (WayForPaySDKException $e) {
            $return = "WayForPay SDK exception: " . $e->getMessage();
            echo $return;
            file_put_contents(public_path('test/serviceUrlData_error.json'), date("H:i").PHP_EOL.$return);
            telegram_bot_error($e);

        } catch (\Throwable $e) {
            file_put_contents(public_path('test/serviceUrlData_throwable.json'), date("H:i").PHP_EOL.$e->getMessage());
            telegram_bot_error($e);
        }

        file_put_contents(public_path('test/serviceUrlData.json'), print_r($json, true));


    }

    public function updateOrderStatus($orderId, $status)
    {
        $order = Order::find($orderId);

        file_put_contents(public_path('test/serviceUrlData-order.json'), json_encode($order));


        try {
            if ($status == Order::STATUS_PAID) {
                foreach ($order->orderItems as $orderItem) {
                    $orderItem->product->update([
                        'quantity' => $orderItem->product->quantity - $orderItem->product_count
                    ]);

                    if ($orderItem->product->quantity <= 0) {
                        $orderItem->product->update([
                            'status' => 'out_of_stock'
                        ]);
                    }
                }
            }

        } catch (\Throwable $e) {
            telegram_bot_error($e);
        }
        // Udate Product if quantity <= 0 to status out of stock and price and old price on 0
        if ($order) {
            $order->update(['payment_status' => $status]);
            telegram_bot_message([
                'payment_status' => $status,
                'orderId' => $orderId,
            ]);
        }else{
            telegram_bot_message('serviceURL else');
        }
    }

    public function notifySuccessOrder($orderId)
    {
        $order = Order::find($orderId);

        if ($order->client_mail_sended == 0 || $order->admin_mail_sended == 0) {
            $order->notify(new OrderClientStoreSend($order));

            $admins = User::get();
            Notification::send($admins, new OrderClientStoreAdmin($order));
            if ($order) {
                $order->update([
                    'client_mail_sended' => 1,
                    'admin_mail_sended' => 1,
                ]);
            }
        }

    }
}
