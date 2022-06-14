<?php

use App\Http\Controllers\Admin\Artikel\ArtikelController;
use App\Http\Controllers\Admin\Dashboard\DashboardController;
use App\Http\Controllers\Admin\RapatYayasan\RapatYayasanController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'auth'], function () {

    Route::controller(DashboardController::class)->prefix('dashboard')->name('dashboard.')->group(function () {
        Route::get('/', 'index')->name('index');
    });

    Route::controller(ArtikelController::class)->prefix('artikel')->name('artikel.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/tambah', 'create')->name('create');
        Route::post('/', 'store')->name('store');
    });

    Route::controller(RapatYayasanController::class)->prefix('rapat-yayasan')->name('rapat-yayasan.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/tambah', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::get('/share/{rapatYayasan}', 'share')->name('share');
        Route::get('/absen-peserta/{rapatYayasan}', 'absenPeserta')->name('absen-peserta');
        Route::get('/{rapatYayasan}', 'show')->name('show');
        Route::get('/{rapatYayasan}/print', 'print')->name('print');
        Route::put('/{rapatYayasan}', 'update')->name('update');
        Route::delete('/{rapatYayasan}', 'delete')->name('delete');
    });
});
