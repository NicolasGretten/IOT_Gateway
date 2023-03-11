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
    Route::get("accounts/", 'list')->middleware('auth');
    Route::post("accounts/password-forgotten", 'passwordForgotten');
    Route::post("accounts/password-reset", 'passwordReset');
    Route::post("accounts/sign-in", 'signIn');
    Route::post("accounts/sign-out", 'signOut')->middleware('auth');
    Route::get("accounts/email-is-available", 'checkIfEmailIsAvailable');
    Route::post("accounts/refresh-token", 'refreshToken')->middleware('auth');
    Route::get("accounts/me", 'me')->middleware('auth');
    Route::get("accounts/search", 'search');
    Route::get("accounts/{id}", 'retrieve');
    Route::post("accounts/", 'create');
    Route::patch("accounts/{id}", 'update')->middleware('auth');
    Route::delete("accounts/{id}", 'delete')->middleware('auth');
    Route::patch("accounts/{id}/restore", 'restore');
});

Route::controller(UserController::class)->group(function () {
    Route::get("users/", 'list')->middleware('auth');
    Route::post("users/", 'create');
    Route::patch("users/{id}", 'update')->middleware('auth');
    Route::delete("users/{id}", 'delete')->middleware('auth');
    Route::get("users/{id}", 'retrieve')->middleware('auth');
});


Route::controller(AddressController::class)->group(function () {
    Route::get("addresses/", 'list')->middleware('auth');
    Route::post("addresses/", 'create');
    Route::patch("addresses/{id}", 'update')->middleware('auth');
    Route::delete("addresses/{id}", 'delete')->middleware('auth');
    Route::get("addresses/{id}", 'retrieve')->middleware('auth');
});

Route::controller(StoreController::class)->group(function () {
    Route::get("stores/", 'list');
    Route::post("stores/", 'create');
    Route::patch("stores/{id}", 'update')->middleware('auth');
    Route::delete("stores/{id}", 'delete')->middleware('auth');
    Route::get("stores/{id}", 'retrieve');
});

Route::controller(StoreClosingController::class)->group(function () {
    Route::post("stores/{id}/closings", 'addClosing')->middleware('auth');
    Route::delete("stores/{id}/closings/{closing_id}", 'removeClosing')->middleware('auth');
});

Route::controller(StoreImageController::class)->group(function () {
    Route::post("stores/{id}/images", 'addImage')->middleware('auth');
    Route::delete("stores/{id}/images/{store_image_id}", 'removeImage')->middleware('auth');
});

Route::controller(StoreMediaController::class)->group(function () {
    Route::post("stores/{id}/medias", 'addMedia')->middleware('auth');
    Route::delete("stores/{id}/medias/{media_id}", 'removeMedia')->middleware('auth');
});

Route::controller(StoreSlotController::class)->group(function () {
    Route::post("stores/{id}/slots", 'addSlot')->middleware('auth');
    Route::patch("stores/{id}/slots/{slot_id}", 'updateSlot')->middleware('auth');
    Route::delete("stores/{id}/slots/{slot_id}", 'removeSlot')->middleware('auth');
});

Route::controller(StoreTranslationController::class)->group(function () {
    Route::post("stores/{id}/translations", 'addTranslation')->middleware('auth');
    Route::delete("stores/{id}/translations", 'removeTranslation')->middleware('auth');
});

Route::controller(ImageController::class)->group(function () {
    Route::get("images/", 'list');
    Route::post("images/", 'upload')->middleware('auth');
    Route::delete("images/{id}", 'delete')->middleware('auth');
    Route::get("images/{id}", 'retrieve');
});

Route::controller(EmployeeController::class)->group(function () {
    Route::get("employees/", 'list')->middleware(['auth','auth.role:admin,super_admin,store_owner']);
    Route::post("employees/", 'create')->middleware(['auth','auth.role:admin,super_admin,store_owner']);
    Route::patch("employees/{id}", 'update')->middleware(['auth','auth.role:admin,super_admin,store_owner']);
    Route::delete("employees/{id}", 'delete')->middleware(['auth','auth.role:admin,super_admin,store_owner']);
    Route::get("employees/{id}", 'retrieve')->middleware(['auth','auth.role:admin,super_admin,store_owner']);
});

Route::controller(AdminController::class)->group(function () {
    Route::get("admins/", 'list')->middleware('auth');
    Route::post("admins/", 'create')->middleware('auth');
    Route::patch("admins/{id}", 'update')->middleware('auth');
    Route::delete("admins/{id}", 'delete')->middleware('auth');
    Route::get("admins/{id}", 'retrieve')->middleware('auth');
});

Route::controller(CategoryController::class)->group(function () {
    Route::get('categories/{id}', 'retrieve');
    Route::get('categories/', 'list');
    Route::post('categories/', 'create')->middleware('auth');
    Route::delete('categories/{id}', 'delete')->middleware('auth');
    Route::post('categories/{id}/translate', 'addTranslation')->middleware('auth');
    Route::delete('categories/{id}/translate', 'removeTranslation')->middleware('auth');
});

Route::controller(ProductController::class)->group(function () {
    Route::get('products/{id}', 'retrieve');
    Route::get('admin/products/', 'listAll')->middleware('auth');
    Route::get('products/', 'list');
    Route::post('products/', 'create')->middleware('auth');
    Route::delete('products/{id}', 'delete')->middleware('auth');
    Route::patch('products/{id}', 'update')->middleware('auth');
    Route::post('products/{id}/translate', 'addTranslation')->middleware('auth');
    Route::delete('products/{id}/translate', 'removeTranslation')->middleware('auth');
    Route::patch('products/{id}/price', 'updatePrice')->middleware('auth');
    Route::post('products/{id}/cart', 'addToCart');
});

Route::controller(CartController::class)->group(function () {
    Route::get('carts/{id}', 'retrieve');
    Route::get('carts/', 'list')->middleware('auth');
    Route::get('carts/users/{user_id}', 'listUserId')->middleware('auth');
    Route::get('carts/stores/{store_id}', 'listStoreId')->middleware('auth');
    Route::post('carts/', 'create');
    Route::patch('carts/{id}', 'update');
    Route::delete('carts/{id}', 'delete');
    Route::patch('carts/{id}/confirm', 'confirm');
    Route::patch('carts/{id}/refund', 'refund');
    Route::patch('carts/{id}/contents/{cart_content_id}', 'updateContent');
    Route::delete('carts/{id}/contents/{cart_content_id}', 'removeContent');
});

Route::controller(OrderController::class)->group(function () {
    Route::get('orders/{id}', 'retrieve')->middleware('auth');
    Route::get('orders/', 'list')->middleware('auth');
    Route::get('orders/users/{user_id}', 'listUserId')->middleware('auth');
    Route::get('orders/stores/{store_id}', 'listStoreId')->middleware('auth');
    Route::post('orders/', 'create')->middleware('auth');
    Route::patch('orders/{id}', 'update')->middleware('auth');
    Route::delete('orders/{id}', 'delete')->middleware('auth');
});

Route::controller(WalletController::class)->group(function () {
    Route::get('stores/wallets/{id}', 'retrieve');
    Route::post('stores/wallets/', 'create');
    Route::patch('stores/wallets/{id}', 'update');
    Route::delete('stores/wallets/{id}', 'delete');
});

Route::controller(PersonController::class)->group(function () {
    Route::get('stores/wallets/{id}/persons/{person_id}', 'retrieve');
    Route::post('stores/wallets/{id}/persons/', 'create');
    Route::get('stores/wallets/{id}/persons/', 'list');
});

Route::controller(ExternalAccountController::class)->group(function () {
    Route::get('stores/wallets/{id}/external-accounts/{external_account_id}', 'retrieve');
    Route::get('stores/wallets/{id}/external-accounts', 'list');
    Route::post('stores/wallets/{id}/external-accounts', 'create');
    Route::patch('stores/wallets/{id}/external-accounts/{external_account_id}', 'update');
    Route::delete('stores/wallets/{id}/external-accounts/{external_account_id}', 'delete');
});

Route::controller(UserStripeController::class)->group(function () {
    Route::get('users/stripe/{id}', 'retrieve');
    Route::get('users/stripe/{id}/check-payment-account', 'checkPaymentAccount');
    Route::post('users/stripe/', 'create');
    Route::patch('users/stripe/{id}', 'update');
    Route::delete('users/stripe/{id}', 'delete');
});

Route::controller(ChargeController::class)->group(function () {
    Route::get('users/stripe/{id}/charges', 'list');
    Route::get('users/stripe/{id}/charges/{charge_id}', 'retrieve');
});

Route::controller(InvoiceController::class)->group(function () {
    Route::get('users/stripe/{id}/invoices', 'list');
    Route::get('users/stripe/{id}/invoices/preview', 'preview');
    Route::get('users/stripe/{id}/invoices/{invoice_id}', 'retrieve');
});

Route::controller(PaymentMethodController::class)->group(function () {
    Route::get('users/stripe/{id}/payments-methods', 'list');
    Route::get('users/stripe/{id}/payments-methods/get-setup-intent', 'getSetupIntent');
    Route::post('users/stripe/{id}/payments-methods/confirm-setup-intent', 'confirmSetupIntent');
    Route::get('users/stripe/{id}/payments-methods/default-payments-method', 'defaultPaymentMethod');
    Route::get('users/stripe/{id}/payments-methods/{payment_method_id}', 'retrieve');
    Route::post('users/stripe/{id}/payments-methods', 'create');
    Route::patch('users/stripe/{id}/payments-methods', 'updateDefaultPaymentMethod');
    Route::delete('users/stripe/{id}/payments-methods', 'delete');
});

Route::controller(PaymentIntentController::class)->group(function () {
    Route::get('payment-intent/{payment_intent_id}', 'retrieve');
});

Route::controller(TokenController::class)->group(function () {
    Route::get('tokens/{token_id}', 'retrieve');
    Route::post('tokens/account', 'accountToken');
    Route::post('tokens/person', 'personToken');
    Route::post('tokens/bank-account', 'bankAccountToken');
    Route::post('tokens/card', 'cardToken');
});

Route::controller(WebhookController::class)->group(function () {
    Route::post('/stripe/webhook', 'handleWebhook');
});

Route::controller(SubscriptionController::class)->group(function () {
    Route::post('users/{id}/subscriptions', 'create');
    Route::patch('users/{id}/subscriptions', 'update');
    Route::delete('users/{id}/subscriptions', 'delete');
    Route::patch('users/{id}/subscriptions/resume', 'resume');
    Route::patch('users/{id}/subscriptions/quantity}', 'quantity');
});

Route::controller(BillController::class)->group(function () {
    Route::get('bills/{id}', 'retrieve');
    Route::get('bills/carts/{cart_id}', 'retrieveByCartId');
    Route::get('bills/', 'list');
    Route::get('bills/users/{user_id}', 'listUserId');
    Route::get('bills/stores/{store_id}', 'listStoreId');
    Route::delete('bills/{id}', 'delete');
    Route::get('bills/{id}/pdf', 'generatePdf');
});
