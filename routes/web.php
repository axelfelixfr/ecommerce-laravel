<?php

use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductInShoppingCartController;
use App\Http\Controllers\ShoppingCartController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('products', ProductController::class);

Route::resource('shopping_cart', ProductInShoppingCartController::class, [
    "only" => ["store", "destroy"]
]);

Route::get('/cart_products', [ShoppingCartController::class, 'show'])->name('cart_products.show');

Route::get('/cart_products/products', [ShoppingCartController::class, 'products'])->name('cart_products.products');

Route::get('/payment', [PaymentController::class, 'pay'])->name('payment.pay');

Route::get('/payment/complete', [PaymentController::class, 'execute'])->name('payment.execute');
