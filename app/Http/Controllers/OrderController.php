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

        session()->forget('cart');

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
            ->setOrderReference(time() .'-'. $order->id)
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
    // public function returnUrl()
    // {
    //     return view('orders.thanks');
    // }
    // public function thanks()
    // {
    //     return view('orders.thanks');
    // }
}
