<?php

use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;

Route::controller(AuthController::class)->group(function () {
    Route::group(['middleware' => 'auth'], function () {
        Route::delete('/logout', 'logout')->name('logout');
    });
    Route::group(['middleware' => 'guest'], function () {
        Route::get('/login', 'login')->name('login');
        Route::post('/login', 'store')->name('login.store');
    });
});
