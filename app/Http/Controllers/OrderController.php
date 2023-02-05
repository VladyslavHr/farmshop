<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreOrderRequest;
use App\Models\{Order,OrderItem};
use App\Http\Requests\{CartStoreRequest};
use App\Http\Classes\Cart;
use WayForPay\SDK\Collection\ProductCollection;
use WayForPay\SDK\Credential\AccountSecretTestCredential;
use WayForPay\SDK\Credential\AccountSecretCredential;
use WayForPay\SDK\Domain\Client;
use WayForPay\SDK\Domain\Product;
use WayForPay\SDK\Wizard\PurchaseWizard;
use WayForPay\SDK\Domain\MerchantTypes;
use WayForPay\SDK\Exception\WayForPaySDKException;
use WayForPay\SDK\Handler\ServiceUrlHandler;



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

        return $this->checkout($data, $order);

        // return redirect()->route('orders.thanks');
    }

    public function checkout($data, $order)
    {
        // dd($data);
        // Use test credential or yours
        // $credential = new AccountSecretTestCredential();
        $credential = new AccountSecretCredential('test_merch_n1', 'flk3409refn54t54t*FNJRET');

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

    public function thanks()
    {
        return view('orders.thanks');
    }
    public function wayForPayReturnUrl()
    {
        // Use test credential or yours
        $credential = new AccountSecretTestCredential();
        //$credential = new AccountSecretCredential('account', 'secret');


        try {
            $handler = new ServiceUrlHandler($credential);
            $response = $handler->parseRequestFromGlobals();

            if ($response->getReason()->isOK()) {
                // dump(request()->all());
                // dump(request('orderReference'));
                // $orderReference =  $response['orderReference'];
                session()->forget('cart');
                $message = 'Tnahk you';
            } else {
                $message = $response->getReason()->getMessage();
                echo $response->getOrderReference();
                // codeError = getOrderReference();
                // echo "Error: " . $response->getReason()->getMessage();
            }
        } catch (WayForPaySDKException $e) {
            echo "WayForPay SDK exception: " . $e->getMessage();
        }
        return view('orders.thanks', [
            'message' => $message,
        ]);
    }
    public function wayForPayServiceUrl()
    {
        // Use test credential or yours
        $credential = new AccountSecretTestCredential();
        // $credential = new AccountSecretCredential('test_merch_n1', 'flk3409refn54t54t*FNJRET');

        try {
            $handler = new ServiceUrlHandler($credential);
            $response = $handler->parseRequestFromPostRaw();

            $return = $handler->getSuccessResponse($response->getTransaction());
            echo $return;
            file_put_contents(storage_path('serviceUrlData_success.json'), $return);

            $json = file_get_contents('php://input');

            $returnObject = json_decode($json);

            $orderId = $returnObject->orderReference;

            $orderId = explode('-', $orderId);

            $orderId = $orderId[1];

            $this->updateOrderStatus($orderId, Order::STATUS_PAID);

        } catch (WayForPaySDKException $e) {
            $return = "WayForPay SDK exception: " . $e->getMessage();
            echo $return;
            file_put_contents(storage_path('serviceUrlData_error.json'), $return);

        }

        // return file_put_contents(storage_path('serviceUrlData.json'), $json);


    }

    public function updateOrderStatus($orderId, $status)
    {
        $order = Order::find($orderId);

        foreach ($order->order_items as $orderItem) {
            $orderItem->product->update([
                'quantity' => $orderItem->product->quantity - $orderItem->product_count
            ]);
        }

        if ($order) {
            $order->update(['payment_status' => $status]);
        }
    }


}
