<?php

use App\Http\Controllers\Admin\Alhisan\AlhisanController;
use App\Http\Controllers\Admin\Artikel\ArtikelController;
use App\Http\Controllers\Admin\Dashboard\DashboardController;
use App\Http\Controllers\Admin\Galeri\PosterDakwahController;
use App\Http\Controllers\Admin\KalimatHikmah\KalimatHikmahController;
use App\Http\Controllers\Admin\Kas\{
    KasMasukController,
    KasKeluarController
};
use App\Http\Controllers\Admin\RapatYayasan\RapatYayasanController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'auth'], function () {

    Route::controller(DashboardController::class)->prefix('dashboard')->name('dashboard.')->group(function () {
        Route::get('/', 'index')->name('index');
    });

    Route::controller(ArtikelController::class)->prefix('artikel')->name('artikel.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/tambah', 'create')->name('create');
        Route::get('/{artikel}', 'show')->name('show');
        Route::get('/{artikel}/ubah', 'edit')->name('edit');
        Route::get('/share/{artikel}', 'share')->name('share');
        Route::post('/', 'store')->name('store');
        Route::put('/{artikel}', 'update')->name('update');
        Route::delete('/{artikel}', 'delete')->name('delete');
    });

    Route::controller(KalimatHikmahController::class)->prefix('kalimat-hikmah')->name('kalimat-hikmah.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/modal-create', 'modalCreate')->name('modal-create');
        Route::get('/{kalimatHikmah}/edit', 'edit')->name('edit');
        Route::post('/', 'store')->name('store');
        Route::put('/{kalimatHikmah}', 'update')->name('update');
        Route::delete('/{kalimatHikmah}', 'delete')->name('delete');
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

    Route::controller(KasMasukController::class)->prefix('kas-masuk')->name('kas-masuk.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::get('/{kasMasuk}/edit', 'edit')->name('edit');
        Route::get('/modal-ekspor-laporan', 'modalEksporLaporan')->name('modal-ekspor-laporan');
        Route::get('/ekspor-laporan', 'eksporLaporan')->name('ekspor-laporan');
        Route::post('/', 'store')->name('store');
        Route::put('/{kasMasuk}', 'update')->name('update');
        Route::delete('/{kasMasuk}', 'delete')->name('delete');
    });

    Route::controller(KasKeluarController::class)->prefix('kas-keluar')->name('kas-keluar.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::get('/{kasKeluar}/edit', 'edit')->name('edit');
        Route::get('/modal-ekspor-laporan', 'modalEksporLaporan')->name('modal-ekspor-laporan');
        Route::get('/ekspor-laporan', 'eksporLaporan')->name('ekspor-laporan');
        Route::post('/', 'store')->name('store');
        Route::put('/{kasKeluar}', 'update')->name('update');
        Route::delete('/{kasKeluar}', 'delete')->name('delete');
    });

    Route::controller(AlhisanController::class)->prefix('alhisan')->name('alhisan.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/{alhisan}/edit', 'edit')->name('edit');
        Route::put('/{alhisan}', 'update')->name('update');
    });

    Route::controller(PosterDakwahController::class)->prefix('poster-dakwah')->name('poster-dakwah.')->group(function () {
        Route::get('/', 'index')->name('index');
    });
});
