<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

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
