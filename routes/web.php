<?php

use App\Http\Controllers\Application\{
    AppController,
};
use Illuminate\Support\Facades\Route;

Route::controller(AppController::class)->group(function () {
    Route::get('/', 'beranda')->name('beranda');
    Route::get('/kontak', 'kontak')->name('kontak');
    Route::get('/tentang-kami', 'tentangKami')->name('tentang-kami');
    Route::get('/visi-misi', 'visiMisi')->name('visi-misi');
    Route::get('/struktur-organisasi', 'strukturOrganisasi')->name('struktur-organisasi');
    Route::get('/galeri', 'galeri')->name('galeri');
    Route::get('/artikel', 'artikel')->name('artikel');
    Route::get('/artikel/{artikel:slug}', 'artikelDetail')->name('artikel-detail');
});
