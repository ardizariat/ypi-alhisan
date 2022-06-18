<?php

namespace App\Repositories\Interface;

interface GaleriInterface
{
    public function posterDakwahAdmin();
    public function posterDakwahApp();
    public function storePosterDakwah($request);
    public function deletePosterDakwah($galeri);
}
