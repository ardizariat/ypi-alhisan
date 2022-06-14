<?php

namespace App\Repositories\Interface;

interface ArtikelInterface
{
    public function artikelApp();

    public function artikelAdmin();

    public function artikelDetail($slug);

    public function kategoriArtikel();
}
