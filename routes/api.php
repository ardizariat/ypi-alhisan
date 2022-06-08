<?php

use App\Http\Controllers\API\Artikel\ArtikelController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\StrukturOrganisasi\PengurusYayasanController;
use App\Http\Controllers\API\Auth\AuthController;

Route::prefix('pengurus-yayasan')->controller(PengurusYayasanController::class)->group(function () {
    Route::get('/', 'pengurusYayasan');
    Route::get('/struktur-organisasi', 'strukturOrganisasi');
});

Route::prefix('artikel')->controller(ArtikelController::class)->group(function () {
    Route::get('/', 'artikel');
    Route::get('/kategori', 'kategori');
    Route::get('/{artikel:slug}', 'artikelDetail');
});

Route::controller(AuthController::class)->group(function () {
    Route::post('/login', 'store')->name('store');
});
