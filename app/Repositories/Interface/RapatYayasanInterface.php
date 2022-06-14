<?php

namespace App\Repositories\Interface;

interface RapatYayasanInterface
{
    public function rapat();

    public function peserta(int $rapatYayasanId);
}
