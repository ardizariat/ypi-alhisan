<?php

namespace App\Repositories\Interface;

interface GaleriInterface
{
    public function galeriAdmin();
    public function galeriApp();
    public function storeGaleri($request);
    public function deleteGaleri($galeri);

    public function posterDakwahAdmin();
    public function posterDakwahApp();
    public function storePosterDakwah($request);
    public function deletePosterDakwah($galeri);
}
