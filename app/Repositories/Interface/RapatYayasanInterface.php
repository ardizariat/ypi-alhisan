<?php

namespace App\Repositories\Interface;

interface RapatYayasanInterface
{
    public function rapat();
    public function peserta(int $rapatYayasanId);
    public function storeRapatYayasan($request);
    public function updateRapatYayasan($rapatYayasan, $request);
    public function deleteRapatYayasan($rapatYayasan);
}
