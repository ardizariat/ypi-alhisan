<?php

namespace App\Repositories;

use App\Repositories\Interface\PengurusYayasanInterface;
use Illuminate\Support\Facades\DB;

class PengurusYayasanRepository implements PengurusYayasanInterface
{
    public function daftarPengurusYayasan($request = '')
    {
        $pengurus = DB::table('pengurus_yayasan as py')
            ->selectRaw('py.nama, py.status')
            ->when(
                $request ?? false,
                fn ($query) =>
                $query->where('py.nama', 'LIKE', '%' . $request . '%')
                    ->orWhere('py.status', 'LIKE', '%' . $request . '%')
            )
            ->where('status', 'aktif')
            ->orderBy('py.nama')
            ->get();

        return $pengurus;
    }

    public function daftarPengurusYayasanAdmin()
    {
        return DB::table('struktur_organisasi as so')
            ->selectRaw('py.id, py.nama, b.nama as bagian, py.status')
            ->join('pengurus_yayasan as py', 'so.pengurus_yayasan_id', '=', 'py.id')
            ->join('bagian as b', 'b.id', '=', 'so.bagian_id')
            ->orderBy('py.nama');
    }

    public function strukturOrganisasi($request = '')
    {
        $strukturOrganisasi = DB::table('struktur_organisasi as so')
            ->join('bagian as b', 'b.id', '=', 'so.bagian_id')
            ->join('pengurus_yayasan as py', 'py.id', '=', 'so.pengurus_yayasan_id')
            ->selectRaw('so.id, py.nama, b.nama as bagian')
            ->when(
                $request ?? false,
                fn ($query) =>
                $query->where('py.nama', 'LIKE', '%' . $request . '%')
                    ->orWhere('py.status', 'LIKE', '%' . $request . '%')
            )
            ->orderBy('so.id')
            ->where('so.status', 'aktif')
            ->get();

        return $strukturOrganisasi;
    }
}
