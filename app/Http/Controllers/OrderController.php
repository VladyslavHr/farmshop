<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
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
use App\Facades\PaymentFacade as Payment;
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


    public function checkout($data, $order)
    {

        $link = Payment::getPaymentLink($order);

        return redirect($link);
        // dd($data);
        // Use test credential or yours
        // $credential = new AccountSecretTestCredential();
        // $credential = new AccountSecretCredential(config('app.merchant_id'), config('app.merchant_secret'));

        // $form = PurchaseWizard::get($credential)
        //     ->setOrderReference($order->order_reference)
        //     ->setAmount($data['total'])
        //     ->setCurrency('UAH')
        //     ->setOrderDate(new \DateTime())
        //     ->setMerchantDomainName('www.wildfarm.com.ua')
        // //    ->setMerchantTransactionType(MerchantTypes::TRANSACTION_AUTO)
        // //    ->setMerchantTransactionType(MerchantTypes::TRANSACTION_AUTH) //  hold
        //     ->setClient(new Client(
        //         $data['name'],
        //         $data['last_name'],
        //         $data['email'],
        //         $data['phone'],
        //     ))
        //     ->setProducts(new ProductCollection(array(
        //         new Product('test', 0.01, 1)
        //     )))
        //     ->setReturnUrl(route('wayForPay.returnUrl'))
        //     ->setServiceUrl(route('wayForPay.serviceUrl'))
        //     ->getForm()
        //     ->getAsString();

        // return view('checkouts.index', [
        //     'credential' => $credential,
        //     'form' => $form,
        // ]);
    }

    public function monobankReturnUrl(Request $request, $orderId)
    {
        // dump($request);
        $order = Order::findOrFail($orderId);

        $response = Http::withHeaders([
            'X-Token' => config('app.monobank_token'),
        ])->get("https://api.monobank.ua/api/merchant/invoice/status?invoiceId={$order->transaction_id}");

        $body = $response->json();
        // dd($body);
        if ($body['status'] === "success") {
            session()->forget('cart');
            $message = 'Tnahk you';
            $isSuccess = true;
        } else {
            $message = $body['status'];
            telegram_bot_message($message);
            $isSuccess = false;
        }

        telegram_bot_message([
            'return_message' => $body,
        ]);

        return view('orders.thanks', [
            'order' => $order,
            'message' => $message,
            'isSuccess' => $isSuccess,
        ]);
    }

    public function monobankWebHook(Request $request, $orderId)
    {
        try {
            $order = Order::findOrFail($orderId);

            $response = Http::withHeaders([
                'X-Token' => config('app.monobank_token'),
            ])->get("https://api.monobank.ua/api/merchant/invoice/status?invoiceId={$order->transaction_id}");

            $body = $response->json();
            // dd($request->all());
            if ($body['status'] === "success") {
                session()->forget('cart');
                $this->updateOrderStatus($orderId, Order::STATUS_PAID);
                $this->notifySuccessOrder($orderId);
            }elseif ($body['status'] != "success"){
                $this->updateOrderStatus($orderId, Order::STATUS_CANCELED);
            }
            //  Order status change
            telegram_bot_message([
                'webHook_message' => $body,
            ]);

            return null;
        } catch (\Throwable $e) {
            echo $e->getMessage();
            telegram_bot_error($e);
        }

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
    public function wayForPayReturnUrl(Request $request)
    {

        dump(getallheaders());
        dd($request->all());
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
