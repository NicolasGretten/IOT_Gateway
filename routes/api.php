<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BillController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Payment\UserStripeController;
use App\Http\Controllers\Payment\WalletController;
use App\Http\Controllers\Payment\ChargeController;
use App\Http\Controllers\Payment\ExternalAccountController;
use App\Http\Controllers\Payment\InvoiceController;
use App\Http\Controllers\Payment\PaymentIntentController;
use App\Http\Controllers\Payment\PersonController;
use App\Http\Controllers\Payment\PaymentMethodController;
use App\Http\Controllers\Payment\TokenController;
use App\Http\Controllers\Payment\WebhookController;
use App\Http\Controllers\Payment\SubscriptionController;
use App\Http\Controllers\Product\CategoryController;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\Store\StoreClosingController;
use App\Http\Controllers\Store\StoreController;
use App\Http\Controllers\Store\StoreImageController;
use App\Http\Controllers\Store\StoreMediaController;
use App\Http\Controllers\Store\StoreSlotController;
use App\Http\Controllers\Store\StoreTranslationController;
use App\Http\Controllers\UserController;
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

Route::controller(AccountController::class)->group(function () {
    Route::get("accounts/", 'listAccount')->middleware('auth');
    Route::post("accounts/password-forgotten", 'passwordForgotten');
    Route::post("accounts/password-reset", 'passwordReset');
    Route::post("accounts/sign-in", 'signIn');
    Route::post("accounts/sign-out", 'signOut')->middleware('auth');
    Route::get("accounts/email-is-available", 'checkIfEmailIsAvailable');
    Route::post("accounts/refresh-token", 'refreshToken')->middleware('auth');
    Route::get("accounts/me", 'me')->middleware('auth');
    Route::get("accounts/search", 'search');
    Route::get("accounts/{id}", 'retrieveAccountAccount');
    Route::post("accounts/", 'createAccount');
    Route::patch("accounts/{id}", 'updateAccount')->middleware('auth');
    Route::delete("accounts/{id}", 'deleteAccount')->middleware('auth');
    Route::patch("accounts/{id}/restore", 'restore');
});

Route::controller(AddressController::class)->group(function () {
    Route::get("addresses/", 'list')->middleware('auth');
    Route::post("addresses/", 'create');
    Route::patch("addresses/{id}", 'update')->middleware('auth');
    Route::delete("addresses/{id}", 'delete')->middleware('auth');
    Route::get("addresses/{id}", 'retrieve')->middleware('auth');
});
