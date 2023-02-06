<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ImageController;
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
    Route::get("accounts/{id}", 'retrieve')->middleware('auth');
    Route::post("accounts/", 'create');
    Route::patch("accounts/{id}", 'update')->middleware('auth');
    Route::delete("accounts/{id}", 'delete')->middleware('auth');
    Route::patch("accounts/{id}/restore", 'restore');
});

Route::controller(UserController::class)->group(function () {
    Route::get("users/", 'list')->middleware('auth');
    Route::post("users/", 'create')->middleware('auth');
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
    Route::post("stores/", 'create')->middleware('auth');
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
    Route::post("images/", 'upload');
    Route::delete("images/{id}", 'delete');
    Route::get("images/{id}", 'retrieve');
});

Route::controller(EmployeeController::class)->group(function () {
    Route::get("employees/", 'list');
    Route::post("employees/", 'create');
    Route::patch("employees/{id}", 'update');
    Route::delete("employees/{id}", 'delete');
    Route::get("employees/{id}", 'retrieve');
});

Route::controller(AdminController::class)->group(function () {
    Route::get("admins/", 'list');
    Route::post("admins/", 'create');
    Route::patch("admins/{id}", 'update');
    Route::delete("admins/{id}", 'delete');
    Route::get("admins/{id}", 'retrieve');
});

Route::controller(CategoryController::class)->group(function () {
    Route::get('categories/{id}', 'retrieve');
    Route::get('categories/', 'list');
    Route::post('categories/', 'create');
    Route::delete('categories/{id}', 'delete');
    Route::post('categories/{id}/translate', 'addTranslation');
    Route::delete('categories/{id}/translate', 'removeTranslation');
});

Route::controller(ProductController::class)->group(function () {
    Route::get('products/{id}', 'retrieve');
    Route::get('products/', 'list');
    Route::post('products/', 'create');
    Route::delete('products/{id}', 'delete');
    Route::patch('products/{id}', 'update');
    Route::post('products/{id}/translate', 'addTranslation');
    Route::delete('products/{id}/translate', 'removeTranslation');
    Route::patch('products/{id}/price', 'updatePrice');
    Route::post('products/{id}/cart', 'addToCart');
});
