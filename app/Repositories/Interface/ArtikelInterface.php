<?php

namespace App\Repositories\Interface;

interface ArtikelInterface
{
    public function artikelApp();

    public function artikelAdmin();

    public function artikelAuthor($userId);

    public function artikelDetail($slug);

    public function kategoriArtikel();

    public function storeArtikel($request);

    public function updateArtikel($artikel, $request);

    public function deleteArtikel($artikel);
}
