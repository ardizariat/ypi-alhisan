<?php

use App\Http\Controllers\Admin\Artikel\ArtikelController;
use App\Http\Controllers\Admin\RapatYayasan\RapatYayasanController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'auth'], function () {
    Route::controller(ArtikelController::class)->prefix('artikel')->name('artikel.')->group(function () {
        Route::get('/', 'index')->name('index');
    });

    Route::controller(RapatYayasanController::class)->prefix('rapat-yayasan')->name('rapat-yayasan.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/tambah', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::delete('/{rapatYayasan}', 'delete')->name('delete');
        Route::get('/share/{rapatYayasan}', 'share')->name('share');
        Route::get('/absen-peserta/{rapatYayasan}', 'absenPeserta')->name('absen-peserta');
    });
});
