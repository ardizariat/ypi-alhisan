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

    public function peserta(int $rapatYayasanId)
    {
        return DB::table('peserta_rapat_yayasan as p')
            ->join('users as u', 'u.id', '=', 'p.user_id')
            ->join('rapat_yayasan as r', 'r.id', '=', 'p.rapat_yayasan_id')
            ->selectRaw('u.name as nama_peserta, p.created_at as waktu_absen')
            ->where('p.rapat_yayasan_id', $rapatYayasanId)
            ->orderByDesc('p.created_at')
            ->get();
    }
}
