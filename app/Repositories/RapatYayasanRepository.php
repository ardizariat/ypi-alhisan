<?php

namespace App\Repositories;

use App\Repositories\Interface\RapatYayasanInterface;
use Illuminate\Support\Facades\DB;

class RapatYayasanRepository implements RapatYayasanInterface
{
    public function rapat()
    {
        return DB::table('rapat_yayasan as ry')
            ->selectRaw('ry.id, ry.tanggal, ry.bahasan, ry.hasil, ry.kode')
            ->orderByDesc('ry.tanggal');
    }
}
