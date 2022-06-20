<?php

namespace App\Repositories;

use App\Models\Artikel;
use App\Repositories\Interface\ArtikelInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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

    public function artikelAuthor($userId)
    {
        return DB::table('artikel as a')
            ->join('kategori as k', 'k.id', '=', 'a.kategori_id')
            ->join('users as u', 'u.id', '=', 'a.user_id')
            ->where('a.user_id', $userId)
            ->selectRaw('
            a.id, u.name as penulis, a.judul, a.konten, k.nama as kategori, a.dipublikasi, a.slug, a.created_at as dibuat, a.status, a.thumbnail
        ')
            ->orderByDesc('a.created_at');
    }

    public function artikelDetail($slug)
    {
        $artikel = DB::table('artikel as a')
            ->join('kategori as k', 'k.id', '=', 'a.kategori_id')
            ->join('users as u', 'u.id', '=', 'a.user_id')
            ->selectRaw('
            a.id, a.kategori_id, u.name as penulis, a.judul, a.konten, k.nama as kategori, a.dipublikasi, a.slug, a.thumbnail, a.status
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
            ->selectRaw('k.nama, k.slug, k.id')
            ->leftJoin('artikel as a', 'a.kategori_id', '=', 'k.id')
            // ->groupBy('k.nama', 'k.id')
            ->where('k.kategori', 'artikel')
            ->get();

        return $kategori;
    }

    public function kategoriArtikelsss()
    {
        $kategori =  DB::table('kategori as k')
            ->selectRaw("COUNT(a.kategori_id) as kategori_count, k.nama, k.slug, k.id")
            ->leftJoin('artikel as a', 'a.kategori_id', '=', 'k.id')
            ->groupBy('k.nama', 'k.id')
            ->where('k.kategori', 'artikel')
            ->get();

        return $kategori;
    }

    public function storeArtikel($request)
    {
        try {
            DB::beginTransaction();

            $slug = Str::slug($request->judul);
            $artikelSlug = Artikel::where('slug', $slug)->first();
            if ($artikelSlug)
                $slug = $slug . rand(1, 10);
            $artikel = new Artikel();
            $artikel->judul = Str::title($request->judul);
            $artikel->slug = $slug;
            $artikel->kategori_id = $request->kategori_id;
            $artikel->user_id = auth()->id();
            $artikel->konten = $request->konten;
            $artikel->status = $request->status ?? 'draft';
            $artikel->dipublikasi = $request->status == 'dipublikasi' ? tanggalSekarang() : null;
            if ($request->hasFile('thumbnail')) {
                $filename = uploadFile($request->file('thumbnail'), 'artikel/');
                $artikel->thumbnail = $filename;
            }
            $artikel->save();

            DB::commit();
            $response = [
                'status_code' => 201,
                'status' => 'success',
                'message' => 'Artikel berhasil dibuat',
                'url' => route('admin.artikel.index')
            ];

            return $response;
        } catch (\Exception $e) {
            DB::rollback();
            $response = [
                'status_code' => 400,
                'status' => 'error',
                'message' => $e->getMessage(),
            ];

            return $response;
        }
    }

    public function updateArtikel($artikel, $request)
    {
        try {
            DB::beginTransaction();

            $slug = Str::slug($request->judul);
            $artikelSlug = Artikel::where('slug', $slug)->first();
            if ($artikelSlug)
                $slug = $slug . rand(1, 10);
            $artikel->judul = Str::title($request->judul);
            $artikel->slug = $slug;
            $artikel->kategori_id = $request->kategori_id;
            $artikel->user_id = auth()->id();
            $artikel->konten = $request->konten;
            $artikel->status = $request->status ?? 'draft';
            $artikel->dipublikasi = $request->status == 'dipublikasi' ? tanggalSekarang() : null;
            if ($request->hasFile('thumbnail')) {
                $thumbnailOld = $artikel->thumbnail;
                if ($thumbnailOld)
                    Storage::delete('artikel/' . $thumbnailOld);
                $filename = uploadFile($request->file('thumbnail'), 'artikel/');
                $artikel->thumbnail = $filename;
            }
            $artikel->update();

            DB::commit();
            $response = [
                'status_code' => 200,
                'status' => 'success',
                'message' => 'Artikel berhasil diupdate',
                'url' => route('admin.artikel.index')
            ];

            return $response;
        } catch (\Exception $e) {
            DB::rollback();
            $response = [
                'status_code' => 400,
                'status' => 'error',
                'message' => $e->getMessage(),
            ];

            return $response;
        }
    }

    public function deleteArtikel($artikel)
    {
        try {
            DB::beginTransaction();
            if ($artikel->thumbnail) {
                $thumbnailOld = $artikel->thumbnail;
                if ($thumbnailOld)
                    Storage::delete('artikel/' . $thumbnailOld);
            }
            $artikel->delete();

            DB::commit();
            $response = [
                'status_code' => 200,
                'status' => 'success',
                'message' => 'Artikel berhasil dihapus',
                'url' => route('admin.artikel.index')
            ];

            return $response;
        } catch (\Exception $e) {
            DB::rollback();
            $response = [
                'status_code' => 400,
                'status' => 'error',
                'message' => $e->getMessage(),
            ];

            return $response;
        }
    }
}
