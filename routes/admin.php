<?php

use App\Http\Controllers\Admin\Agenda\AgendaController;
use App\Http\Controllers\Admin\Alhisan\AlhisanController;
use App\Http\Controllers\Admin\Artikel\ArtikelController;
use App\Http\Controllers\Admin\Artikel\KategoriArtikelController;
use App\Http\Controllers\Admin\Dashboard\DashboardController;
use App\Http\Controllers\Admin\Galeri\GaleriController;
use App\Http\Controllers\Admin\Galeri\PosterDakwahController;
use App\Http\Controllers\Admin\Inventaris\InventarisController;
use App\Http\Controllers\Admin\Inventaris\KategoriInventarisController;
use App\Http\Controllers\Admin\KalimatHikmah\KalimatHikmahController;
use App\Http\Controllers\Admin\Kas\{
    KasMasukController,
    KasKeluarController
};
use App\Http\Controllers\Admin\RapatYayasan\RapatYayasanController;
use App\Http\Controllers\Admin\User\RoleAndPermissionController;
use App\Http\Controllers\Admin\User\UserController;
use App\Http\Controllers\Admin\PengurusYayasan\PengurusYayasanController;
use App\Http\Controllers\Admin\User\AktifitasUserController;
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

    Route::controller(KategoriArtikelController::class)->prefix('kategori-artikel')->name('kategori-artikel.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/tambah', 'create')->name('create');
        Route::get('/{kategori}/ubah', 'edit')->name('edit');
        Route::post('/', 'store')->name('store');
        Route::put('/{kategori}', 'update')->name('update');
        Route::delete('/{kategori}', 'delete')->name('delete');
    });

    Route::controller(KategoriInventarisController::class)->prefix('kategori-inventaris')->name('kategori-inventaris.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/tambah', 'create')->name('create');
        Route::get('/{kategori}/ubah', 'edit')->name('edit');
        Route::post('/', 'store')->name('store');
        Route::put('/{kategori}', 'update')->name('update');
        Route::delete('/{kategori}', 'delete')->name('delete');
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
        Route::get('/{rapatYayasan}/edit', 'edit')->name('edit');
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

    Route::controller(RoleAndPermissionController::class)->prefix('role-permission')->name('role-permission.')->group(function () {
        Route::get('/', 'rolePermission')->name('index');
        // ---------- Role ---------- //
        Route::get('/create-role', 'createRole')->name('create-role');
        Route::post('/store-role', 'storeRole')->name('store-role');
        Route::get('/edit-role/{id}', 'editRole')->name('edit-role');
        Route::put('/update-role/{id}', 'updateRole')->name('update-role');
        Route::delete('/delete-role/{id}', 'deleteRole')->name('delete-role');

        // ---------- permission ---------- //
        Route::get('/create-permission', 'createPermission')->name('create-permission');
        Route::post('/store-permission', 'storePermission')->name('store-permission');
        Route::get('/edit-permission/{id}', 'editPermission')->name('edit-permission');
        Route::put('/update-permission/{id}', 'updatePermission')->name('update-permission');
        Route::delete('/delete-permission/{id}', 'deletePermission')->name('delete-permission');
    });


    Route::controller(UserController::class)->prefix('user')->name('user.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/tambah', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::get('/{user}/edit', 'edit')->name('edit');
        Route::put('/{user}', 'update')->name('update');
        Route::put('/{user}/reset-password', 'resetPassword')->name('reset-password');
        Route::delete('/{user}', 'delete')->name('delete');
    });

    Route::controller(AktifitasUserController::class)->prefix('aktifitas-user')->name('aktifitas-user.')->group(function () {
        Route::get('/', 'index')->name('index');
    });

    Route::controller(PosterDakwahController::class)->prefix('poster-dakwah')->name('poster-dakwah.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/tambah', 'create')->name('create');
        Route::get('/{galeri}', 'show')->name('show');
        Route::post('/', 'store')->name('store');
        Route::delete('/{galeri}', 'delete')->name('delete');
    });

    Route::controller(GaleriController::class)->prefix('galeri')->name('galeri.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/tambah', 'create')->name('create');
        Route::get('/{galeri}', 'show')->name('show');
        Route::post('/', 'store')->name('store');
        Route::delete('/{galeri}', 'delete')->name('delete');
    });

    Route::controller(AgendaController::class)->prefix('agenda')->name('agenda.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/tambah', 'create')->name('create');
        Route::get('/{agenda}/edit', 'edit')->name('edit');
        Route::get('/{agenda}', 'show')->name('show');
        Route::post('/', 'store')->name('store');
        Route::put('/{agenda}', 'update')->name('update');
        Route::delete('/{agenda}', 'delete')->name('delete');
    });

    Route::controller(PengurusYayasanController::class)->prefix('pengurus-yayasan')->name('pengurus-yayasan.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/struktur-organisasi', 'strukturOrganisasi')->name('struktur-organisasi');
        Route::get('/tambah', 'create')->name('create');
        Route::get('/{pengurusYayasan}', 'show')->name('show');
        Route::get('/{pengurusYayasan}/ubah', 'edit')->name('edit');
        Route::post('/', 'store')->name('store');
        Route::put('/{pengurusYayasan}', 'update')->name('update');
        Route::delete('/{pengurusYayasan}', 'delete')->name('delete');
    });

    Route::controller(UserController::class)->prefix('profil-saya')->group(function () {
        Route::get('/{user:username}', 'profil')->name('profil-saya');
        Route::get('/{user}/edit-profil', 'editProfil')->name('edit-profil');
        Route::put('/{user}/update-profil', 'updateProfil')->name('update-profil');
        Route::put('/{user}/update-password', 'updatePassword')->name('update-password');
    });

    Route::controller(InventarisController::class)->prefix('inventaris')->name('inventaris.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/tambah', 'create')->name('create');
        Route::get('/modal-ekspor', 'modalEkspor')->name('modal-ekspor');
        Route::get('/ekspor-laporan', 'eksporLaporan')->name('ekspor-laporan');
        Route::get('/{inventaris}', 'show')->name('show');
        Route::get('/{inventaris}/ubah', 'edit')->name('edit');
        Route::post('/', 'store')->name('store');
        Route::put('/{inventaris}', 'update')->name('update');
        Route::delete('/{inventaris}', 'delete')->name('delete');
    });
});
