<?php

use App\Http\Controllers\AccountController;
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
    Route::get("accounts/", 'list');
    Route::post("accounts/password-forgotten", 'passwordForgotten');
    Route::post("accounts/password-reset", 'passwordReset');
    Route::post("accounts/sign-in", 'signIn');
    Route::post("accounts/sign-out", 'signOut');
    Route::get("accounts/email-is-available", 'checkIfEmailIsAvailable');
    Route::post("accounts/refresh-token", 'refreshToken');
    Route::get("accounts/me", 'me');
    Route::get("accounts/search", 'search');
    Route::get("accounts/{id}", 'retrieve');
    Route::post("accounts/{id}", 'create');
    Route::patch("accounts/{id}", 'update');
    Route::delete("accounts/{id}", 'delete');
    Route::patch("accounts/{id}/restore", 'restore');
});
