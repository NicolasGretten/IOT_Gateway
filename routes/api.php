<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\MovementController;
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

Route::controller(MovementController::class)->group(function () {
    Route::post("movements/left", 'left');
    Route::post("movements/right", 'right');
    Route::post("movements/stop", 'stop');
    Route::post("movements/backward", 'backward');
    Route::post("movements/forward", 'forward');
    Route::post("movements/exit", 'exit');
});
