<?php

namespace App\Repositories;

use App\Models\Kategori;
use App\Repositories\Interface\KategoriInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class KategoriRepository implements KategoriInterface
{
    public $artikel = 'artikel';

    public function kategoriArtikelAdmin()
    {
        return DB::table('kategori as k')
            ->selectRaw('k.*')
            ->where('k.kategori', $this->artikel)
            ->orderByDesc('k.nama');
    }

    public function storeKategoriArtikel($request)
    {
        try {
            DB::beginTransaction();
            $slug = Str::slug($request->nama);
            $kategoriSlug = Kategori::where('slug', $slug)->first();
            if ($kategoriSlug)
                $slug = $slug . rand(1, 10);
            $kategori = new Kategori();
            $kategori->nama = $request->nama;
            $kategori->slug = $slug;
            $kategori->kategori = $this->artikel;
            $kategori->save();

            DB::commit();
            $response = [
                'status_code' => 201,
                'status' => 'success',
                'message' => 'Data berhasil dibuat',
                'url' => route('admin.kategori-artikel.index')
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

    public function updateKategoriArtikel($kategori, $request)
    {
        try {
            DB::beginTransaction();
            $kategori->nama = $request->nama;
            $kategori->update();

            DB::commit();
            $response = [
                'status_code' => 200,
                'status' => 'success',
                'message' => 'Data berhasil diupdate',
                'url' => route('admin.kategori-artikel.index')
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
