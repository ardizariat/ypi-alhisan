<?php

namespace App\Repositories\Interface;

interface ArtikelInterface
{
    public function artikel();

    public function artikelDetail($slug);

    public function kategoriArtikel();
}
