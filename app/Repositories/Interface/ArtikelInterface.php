<?php

namespace App\Repositories\Interface;

interface ArtikelInterface
{
    public function artikel(array $request);

    public function artikelDetail($slug);

    public function kategoriArtikel();
}
