<?php

namespace App\Http\Controllers;

use App\Models\Checkout;
use Illuminate\Http\Request;
use WayForPay\SDK\Collection\ProductCollection;
use WayForPay\SDK\Credential\AccountSecretTestCredential;
use WayForPay\SDK\Domain\Client;
use WayForPay\SDK\Domain\Product;
use WayForPay\SDK\Wizard\PurchaseWizard;
use WayForPay\SDK\Domain\MerchantTypes;
use App\Models\{Order,OrderItem};

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Use test credential or yours
        $credential = new AccountSecretTestCredential();
        //$credential = new AccountSecretCredential('account', 'secret');

        $form = PurchaseWizard::get($credential)
            ->setOrderReference(sha1(microtime(true)))
            ->setAmount(0.01)
            ->setCurrency('UAH')
            ->setOrderDate(new \DateTime())
            ->setMerchantDomainName('https://google.com')
        //    ->setMerchantTransactionType(MerchantTypes::TRANSACTION_AUTO)
        //    ->setMerchantTransactionType(MerchantTypes::TRANSACTION_AUTH) //  hold
            ->setClient(new Client(
                'John',
                'Dou',
                'john.dou@gmail.com',
                '+12025550152',
                'USA'
            ))
            ->setProducts(new ProductCollection(array(
                new Product('test', 0.01, 1)
            )))
            ->setReturnUrl('http://localhost:8000/examples/returnUrl.php')
            ->setServiceUrl('http://localhost:8000/examples/serviceUrl.php')
            ->getForm()
            ->getAsString();

        return view('checkouts.index', [
            'credential' => $credential,
            'form' => $form,
        ]);
    }

    public function mailTest()
    {


        $order = Order::findOrFail(2);

        // foreach ($order->items as $item) {
        //     $season = Season::where('date_from', '<=', $item->date)
        //     ->where('date_to', '>=', $item->date)->first();

        //     $stops = Stop::whereIn('id', [$item->stop_id_from, $item->stop_id_to])->get()->keyBy('id');

        //     $direction = ($stops[$item->stop_id_to]->sorting - $stops[$item->stop_id_from]->sorting > 0) ? 'up' : 'down';

        //     $departs = Depart::where('stop_id', $item->stop_id_from)
        //     ->where('season_id', $season->id)
        //     ->where('direction', $direction)->get();
        // }



        $path = 'logo/logoimg.png';
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data_img = file_get_contents($path);
        $logo = 'data:image/' . $type . ';base64,' . base64_encode($data_img);
        return view('emails.orders.store', [
            'order' => $order,
            'logo' => $logo,
            // 'payment_method' => $payment_method,
            // 'self_shipping' => $self_shipping,
            // 'new_post_num' => $new_post_num,
            // 'new_post_city' => $new_post_city,
            // 'new_post_adress' => $new_post_adress,
            // 'product_quantity' => $order->product_quantity,
            // 'note' => $this->order->order_note,
            // 'total_price' => number_format($order->total, 0, '.', ' '),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Checkout  $checkout
     * @return \Illuminate\Http\Response
     */
    public function show(Checkout $checkout)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Checkout  $checkout
     * @return \Illuminate\Http\Response
     */
    public function edit(Checkout $checkout)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Checkout  $checkout
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Checkout $checkout)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Checkout  $checkout
     * @return \Illuminate\Http\Response
     */
    public function destroy(Checkout $checkout)
    {
        //
    }
}
