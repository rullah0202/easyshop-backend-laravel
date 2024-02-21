<?php

use App\Http\Controllers\Api\AddressController;
use App\Http\Controllers\Api\CheckoutController;
use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/get-all-products', [HomeController::class, 'index']);
Route::get('/search-by-name/{title}', [ProductController::class, 'show']);
Route::get('/get-product-by-id/{product}', [ProductController::class, 'productById']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('users',[UserController::class, 'index']);

    Route::get('/get-address-by-user/{id}',[AddressController::class, 'index']);
    Route::post('/add-address',[AddressController::class, 'store']);
    Route::patch('/update-address/{address}',[AddressController::class, 'update']);

    Route::get('/checkout', [CheckoutController::class, 'index']);
    Route::post('/checkout', [CheckoutController::class, 'store']);
    Route::put('/checkout/{id}', [CheckoutController::class, 'update']);

    Route::get('/get-orders-by-user', [OrderController::class, 'index']);

    // Route::get('/checkout_success', function () {
    //     return Inertia::render('CheckoutSuccess');
    // })->name('checkout_success.index');
});
