<?php

namespace App\Repositories\Interface;

interface KalimatHikmahInterface
{
    public function kalimatHikmahAdmin();
    public function storeKalimatHikmah($request);
    public function updateKalimatHikmah($kalimatHikmah, $request);
    public function deleteKalimatHikmah($kalimatHikmah);
}
