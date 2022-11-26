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
