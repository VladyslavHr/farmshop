<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\ProductTypeController as AdminProductTypeController;
use App\Http\Controllers\Admin\ProductCategoryController as AdminProductCategoryController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('home');
})->name('home');
// ->middleware(['auth'])
require __DIR__.'/auth.php';


Route::get('/parsers/agriculture', [\App\Http\Controllers\ArticleController::class, 'agriculture'])->name('parsers.agriculture');
Route::any('/parsers/agriculture/parsePage/{page_num}', [\App\Http\Controllers\ArticleController::class, 'ac_parsePage']);




Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function() {

    // Dashboard
    Route::get('/', [AdminDashboardController::class, 'index'])->name('admin.dashboard.index');



    // Products
    Route::get('/products', [AdminProductController::class, 'index'])->name('admin.products.index');
    Route::get('/products/create', [AdminProductController::class, 'create'])->name('admin.products.create');
    Route::get('/products/show/{product}', [AdminProductController::class, 'show'])->name('admin.products.show');
    Route::post('/products/store', [AdminProductController::class, 'store'])->name('admin.products.store');
    Route::get('/products/edit', [AdminProductController::class, 'edit'])->name('admin.products.edit');
    Route::post('/products/update/{product}', [AdminProductController::class, 'update'])->name('admin.products.update');
    Route::delete('/products/{id}', [AdminProductController::class, 'delete'])->name('admin.products.delete');

    // PriductTypes
    Route::get('/products-types', [AdminProductTypeController::class, 'index'])->name('admin.productTypes.index');
    Route::get('/products-types/create', [AdminProductTypeController::class, 'create'])->name('admin.productTypes.create');
    Route::post('/products-types/store', [AdminProductTypeController::class, 'store'])->name('admin.productTypes.store');
    Route::get('/products-types/edit/{product_type}', [AdminProductTypeController::class, 'edit'])->name('admin.productTypes.edit');
    Route::post('/products-types/update/{product_type}', [AdminProductTypeController::class, 'update'])->name('admin.productTypes.update');
    Route::delete('/products-types/{id}', [AdminProductTypeController::class, 'delete'])->name('admin.productTypes.delete');

    // ProductCategories
    Route::get('/products-categories', [AdminProductCategoryController::class, 'index'])->name('admin.productCategories.index');
    Route::get('/products-categories/create', [AdminProductCategoryController::class, 'create'])->name('admin.productCategories.create');
    Route::post('/products-categories/store', [AdminProductCategoryController::class, 'store'])->name('admin.productCategories.store');
    Route::get('/products-categories/edit/{product_category}', [AdminProductCategoryController::class, 'edit'])->name('admin.productCategories.edit');
    Route::post('/products-categories/update/{product_category}', [AdminProductCategoryController::class, 'update'])->name('admin.productCategories.update');
    Route::delete('/products-categories/{id}', [AdminProductCategoryController::class, 'delete'])->name('admin.productCategories.delete');

});
