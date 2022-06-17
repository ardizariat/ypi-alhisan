<?php

namespace App\Repositories\Interface;

interface GaleriInterface
{
    public function posterDakwahAdmin();
    public function storePosterDakwah($request);
    public function deletePosterDakwah($galeri);
}
