<?php

use App\Http\Controllers\AccountController;
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
    Route::post("accounts/{id}", 'create');
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
