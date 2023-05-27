<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use App\Models\{Order,OrderItem,User};
use Illuminate\Support\Facades\Notification;
use App\Notifications\{OrderClientStoreSend,OrderClientStoreAdmin};
use App\Facades\PaymentFacade as Payment;
// use Mail;
/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');



Artisan::command('get-folders', function (){
    $folders = scandir(public_path('storage'));

    foreach ($folders as $folderName) {
       echo $folderName;
       echo PHP_EOL;
    }
});


Artisan::command('testt', function (){

    dd(route('monobank.webHook'));

    return;
    $order = Order::find(27);


    $link = Payment::getPaymentLink($order);






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






    // try {
    //     $asd[6];
    // } catch (\Throwable $e) {
    //     telegram_bot_error($e);
    // }




    // $order = \App\Models\Order::find(30);
    // // echo $produtcs->count();
    // // print_r();
    // $order->notify(new OrderClientStoreSend($order));

    // $admin = User::where('id', 1)->first();
    // // Notification::send($users, new InvoicePaid($invoice));
    // Notification::send($admin, new OrderClientStoreAdmin($order));
    // $admin->notify(new OrderClientStoreAdmin($order));


    // dd($order->items);
});


Artisan::command('create-folders', function (){
    $folders = [
        'product-categories-img',
        'product-categories-img-medium',
        'product-categories-img-small',
        'product-categories-logo',
        'product-categories-logo-medium',
        'product-categories-logo-small',
        'product-gallery',
        'product-gallery-medium',
        'product-gallery-small',
        'product-img',
        'product-img-medium',
        'product-img-small',
        'product-logo',
        'product-logo-medium',
        'product-logo-small',
        'product-type-img',
        'product-type-img-medium',
        'product-type-img-small',
        'product-type-logo',
        'product-type-logo-medium',
        'product-type-logo-small',

    ];

    foreach ($folders as $folderName) {
        @mkdir(public_path('storage/' . $folderName));
    }
});



Artisan::command('notif', function(){
    $order = Order::where('id', 12)->first();
    $admins = User::where('id', 1)->first();
    // Notification::send($users, new InvoicePaid($invoice));
    Notification::send($admins, new OrderClientStoreAdmin($order));
});


Artisan::command('message', function(){

    telegram_bot_message('Hi');
});


Artisan::command('sendMail', function() {
    $order = Order::find(23);

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

        // Работает без fillable
        // if ($order) {
        //     $order->client_mail_sended = 1;
        //     $order->admin_mail_sended = 1;
        //     $order->save();
        // }

    }
});
