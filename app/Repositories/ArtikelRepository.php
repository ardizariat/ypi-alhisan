<?php

namespace App\Repositories;

use App\Repositories\Interface\ArtikelInterface;
use Illuminate\Support\Facades\DB;

class ArtikelRepository implements ArtikelInterface
{
    public function artikelApp()
    {
        return DB::table('artikel as a')
            ->join('kategori as k', 'k.id', '=', 'a.kategori_id')
            ->join('users as u', 'u.id', '=', 'a.user_id')
            ->selectRaw('
            a.id, u.name as penulis, a.judul, a.konten, k.nama as kategori, a.dipublikasi, a.slug, a.created_at as dibuat, a.status, a.thumbnail
        ')
            ->where('a.status', 'dipublikasi')
            ->whereNotNull('a.dipublikasi')
            ->orderByDesc('a.dipublikasi');
    }

    public function artikelAdmin()
    {
        return DB::table('artikel as a')
            ->join('kategori as k', 'k.id', '=', 'a.kategori_id')
            ->join('users as u', 'u.id', '=', 'a.user_id')
            ->selectRaw('
            a.id, u.name as penulis, a.judul, a.konten, k.nama as kategori, a.dipublikasi, a.slug, a.created_at as dibuat, a.status, a.thumbnail
        ')
            ->orderByDesc('a.dipublikasi');
    }

    public function artikelDetail($slug)
    {
        $artikel = DB::table('artikel as a')
            ->join('kategori as k', 'k.id', '=', 'a.kategori_id')
            ->join('users as u', 'u.id', '=', 'a.user_id')
            ->selectRaw('
            a.id, u.name as penulis, a.judul, a.konten, k.nama as kategori, a.dipublikasi, a.slug, a.thumbnail
        ')
            ->where('a.slug', $slug)
            ->where('a.status', 'dipublikasi')
            ->whereNotNull('a.dipublikasi')
            ->first();

        return $artikel;
    }


    public function kategoriArtikel()
    {
        $kategori =  DB::table('kategori as k')
            ->selectRaw("COUNT(a.kategori_id) as kategori_count, k.nama, k.slug, k.id")
            ->leftJoin('artikel as a', 'a.kategori_id', '=', 'k.id')
            ->groupBy('k.nama', 'k.id')
            ->get();

        return $kategori;
    }
}
