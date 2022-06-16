<?php

namespace App\Repositories\Interface;

interface KasKeluarInterface
{
    public function kasKeluarAdmin();

    public function storeKasKeluar($request);

    public function updateKasKeluar($kasKeluar, $request);

    public function deleteKasKeluar($kasKeluar);

    public function dataLaporanKasKeluar($dari, $sampai);
}
