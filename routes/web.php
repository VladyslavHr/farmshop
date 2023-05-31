<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\ProductTypeController as AdminProductTypeController;
use App\Http\Controllers\Admin\ProductCategoryController as AdminProductCategoryController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\NoteController as AdminNoteController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\{ProductController,CartController,OrderController,CheckoutController,HomeController,ProductTypeController,ContactController};
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/sitemap.xml', [App\Http\Controllers\Controller::class, 'sitemap'])->name('sitemap');
// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/', function () {
//     return view('home');
// })->name('home');

Route::any('gopay-notification', [\App\Http\Controllers\HomeController::class, 'goPayNotification']);

Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('home.index');



// Route::any('/wayForPay/returnUrl', [\App\Http\Controllers\OrderController::class, 'wayForPayReturnUrl'])->name('wayForPay.returnUrl');
// Route::any('/wayForPay/serviceUrl', [\App\Http\Controllers\OrderController::class, 'wayForPayServiceUrl'])->name('wayForPay.serviceUrl');

Route::any('/mono/returnUrl/{orderId}', [\App\Http\Controllers\OrderController::class, 'monobankReturnUrl'])->name('monobank.returnUrl');
Route::any('/mono/webHook/{orderId}', [\App\Http\Controllers\OrderController::class, 'monobankWebHook'])->name('monobank.webHook');



// Route::any('/wayForPay/returnUrl', function () {
//     dump(request()->all());
// })->name('wayForPay.returnUrl');

// Route::any('/wayForPay/serviceUrl', function () {
//     file_put_contents(storage_path('serviceUrlData.json'), json_encode(request()->all(), 128));
// })->name('wayForPay.serviceUrl');

require __DIR__.'/auth.php';


Route::get('/parsers/agriculture', [\App\Http\Controllers\ArticleController::class, 'agriculture'])->name('parsers.agriculture');
Route::any('/parsers/agriculture/parsePage', [\App\Http\Controllers\ArticleController::class, 'ac_parsePage']);



Route::get('/tovary', [\App\Http\Controllers\ProductController::class, 'index'])->name('products.index');
Route::get('/tovary/{slug}', [\App\Http\Controllers\ProductController::class, 'show'])->name('products.show');


// Cart
// Route::post('/tovary/addToCart/{id}', [App\Http\Controllers\ProductController::class, 'addToCart'])->name('products.addToCart');

Route::post('/tovary/addToCart/{product}', [ProductController::class, 'addToCart'])->name('addToCart');
Route::post('/tovary/removeFromCart/{product}', [ProductController::class, 'removeFromCart'])->name('removeFromCart');
Route::post('/tovary/clearCart/', [ProductController::class, 'clearCart'])->name('clearCart');
Route::post('/tovary/updateCart/', [ProductController::class, 'updateCart'])->name('updateCart');


Route::get('/kosik', [CartController::class, 'index'])->name('carts.index');
Route::post('/kosik-dodano/{product}', [CartController::class, 'approve'])->name('carts.approve');


// Route::get('/zamovlennya', [CartController::class, 'cartStore'])->name('carts.cartStore');

Route::get('/dyakujemo/{order}', [OrderController::class, 'thanks'])->name('orders.thanks');
Route::get('/zamovlennya', [OrderController::class, 'index'])->name('orders.index');
Route::post('/zamovlennya/store', [OrderController::class, 'store'])->name('orders.store');

Route::get('/checkoutMono', [OrderController::class, 'checkoutMono'])->name('checkouts.checkoutMono');



Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkouts.index');



// ProdutcTypes
Route::get('/kramnytsya/{slug}', [ProductTypeController::class, 'show'])->name('productTypes.show');

// Contacts
Route::get('/kontakty', [ContactController::class, 'index'])->name('contacts.index');
Route::get('/dostavka-i-oplata', [ContactController::class, 'payAndDelivery'])->name('contacts.payAndDelivery');
Route::get('/povernenya-tovaru', [ContactController::class, 'retunrRules'])->name('contacts.retunrRules');
Route::post('/kontakty/store', [ContactController::class, 'store'])->name('contacts.store');



Route::get('/mailTest', [App\Http\Controllers\CheckoutController::class, 'mailTest']);

Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function() {

    // Dashboard
    Route::get('/', [AdminDashboardController::class, 'index'])->name('admin.dashboard.index');

    // Orders
    Route::get('/orders', [AdminOrderController::class, 'index'])->name('admin.orders.index');
    Route::get('/order/show/{order}', [AdminOrderController::class, 'show'])->name('admin.orders.show');
    Route::post('/order/update/{order}', [AdminOrderController::class, 'update'])->name('admin.orders.update');



    // Products
    Route::get('/products', [AdminProductController::class, 'index'])->name('admin.products.index');
    Route::get('/products/create', [AdminProductController::class, 'create'])->name('admin.products.create');
    Route::get('/products/show/{product}', [AdminProductController::class, 'show'])->name('admin.products.show');
    Route::post('/products/store', [AdminProductController::class, 'store'])->name('admin.products.store');
    Route::get('/products/edit/{product}', [AdminProductController::class, 'edit'])->name('admin.products.edit');
    Route::post('/products/update/{product}', [AdminProductController::class, 'update'])->name('admin.products.update');
    Route::delete('/products/{id}', [AdminProductController::class, 'delete'])->name('admin.products.delete');




    // PriductTypes
    Route::get('/products-types', [AdminProductTypeController::class, 'index'])->name('admin.productTypes.index');

    Route::get('/products-categories-list/{product_type}', [AdminProductTypeController::class, 'categoriesListToType'])->name('admin.productCategories.categoriesListToType');

    Route::get('/products-types/create', [AdminProductTypeController::class, 'create'])->name('admin.productTypes.create');
    Route::post('/products-types/store', [AdminProductTypeController::class, 'store'])->name('admin.productTypes.store');
    Route::get('/products-types/edit/{product_type}', [AdminProductTypeController::class, 'edit'])->name('admin.productTypes.edit');
    Route::post('/products-types/update/{product_type}', [AdminProductTypeController::class, 'update'])->name('admin.productTypes.update');
    Route::delete('/products-types/{id}', [AdminProductTypeController::class, 'delete'])->name('admin.productTypes.delete');

    // ProductCategories
    Route::get('/products-categories', [AdminProductCategoryController::class, 'index'])->name('admin.productCategories.index');

    Route::get('/products-list/{product_category}', [AdminProductCategoryController::class, 'productsListToCategory'])->name('admin.products.productsListToCategory');

    // Route::get('/products-categories-list', [AdminProductCategoryController::class, 'categoriesListToType'])->name('admin.productCategories.categoriesListToType');
    Route::get('/products-categories/create', [AdminProductCategoryController::class, 'create'])->name('admin.productCategories.create');
    Route::post('/products-categories/store', [AdminProductCategoryController::class, 'store'])->name('admin.productCategories.store');
    Route::get('/products-categories/edit/{product_category}', [AdminProductCategoryController::class, 'edit'])->name('admin.productCategories.edit');
    Route::post('/products-categories/update/{product_category}', [AdminProductCategoryController::class, 'update'])->name('admin.productCategories.update');
    Route::delete('/products-categories/{id}', [AdminProductCategoryController::class, 'delete'])->name('admin.productCategories.delete');

    // Notes
    Route::get('/notes', [AdminNoteController::class, 'index'])->name('admin.notes.index');
    Route::get('/notes/create', [AdminNoteController::class, 'create'])->name('admin.notes.create');
    Route::post('/notes/store', [AdminNoteController::class, 'store'])->name('admin.notes.store');
    Route::get('/notes/edit/{note}', [AdminNoteController::class, 'edit'])->name('admin.notes.edit');
    Route::put('/notes/update/{note}', [AdminNoteController::class, 'update'])->name('admin.notes.update');
    Route::delete('/notes/delete/{note}', [AdminNoteController::class, 'delete'])->name('admin.notes.delete');


    // Users
    Route::get('/users', [AdminUserController::class, 'index'])->name('admin.users.index');
    Route::get('/user/create', [AdminUserController::class, 'create'])->name('admin.users.create');
    Route::post('/user/store', [AdminUserController::class, 'store'])->name('admin.users.store');
    Route::get('/user/edit/{user}', [AdminUserController::class, 'edit'])->name('admin.users.edit');
    Route::post('/user/update/{user}', [AdminUserController::class, 'update'])->name('admin.users.update');
    Route::post('/user/updatePassword/{user}', [AdminUserController::class, 'updatePassword'])->name('admin.users.updatePassword');
    Route::delete('/user/{id}', [AdminUserController::class, 'delete'])->name('admin.users.delete');
});


