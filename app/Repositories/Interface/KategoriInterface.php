<?php

namespace App\Repositories\Interface;

interface KategoriInterface
{
    public function kategoriAdmin($kategori);
    public function storeKategori($request, $kategoriSub, $url);
    public function updateKategori($kategori, $request, $url);
}
