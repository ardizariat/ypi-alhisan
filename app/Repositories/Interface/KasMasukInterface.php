<?php

namespace App\Repositories\Interface;

interface KasMasukInterface
{
    public function kasMasukAdmin();

    public function storeKasMasuk($request);

    public function updateKasMasuk($kasMasuk, $request);

    public function deleteKasMasuk($kasMasuk);

    public function dataLaporanKasMasuk($dari, $sampai);
}
