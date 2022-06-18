<?php

namespace App\Repositories\Interface;

interface KategoriInterface
{
    public function kategoriArtikelAdmin();
    public function storeKategoriArtikel($request);
    public function updateKategoriArtikel($kategori, $request);
}
