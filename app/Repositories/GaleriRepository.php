<?php

namespace App\Repositories;

use App\Models\Galeri;
use App\Repositories\Interface\GaleriInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class GaleriRepository implements GaleriInterface
{
    public $kategoriPosterDakwah = 1;

    public function posterDakwahAdmin()
    {
        return DB::table('galeri as g')
            ->selectRaw('g.*')
            ->where('g.kategori_id', $this->kategoriPosterDakwah)
            ->orderByDesc('g.created_at');
    }

    public function posterDakwahApp()
    {
        return DB::table('galeri as g')
            ->selectRaw('g.*')
            ->where('g.kategori_id', $this->kategoriPosterDakwah)
            ->orderByDesc('g.created_at');
    }

    public function storePosterDakwah($request)
    {
        try {
            DB::beginTransaction();

            $posterDakwah = new Galeri();
            $posterDakwah->keterangan = $request->keterangan;
            $posterDakwah->kategori_id = $this->kategoriPosterDakwah;
            if ($request->hasFile('filename')) {
                $filename = uploadFile($request->file('filename'), 'posterDakwah/');
                $posterDakwah->filename = $filename;
            }
            $posterDakwah->save();

            DB::commit();
            $response = [
                'status_code' => 201,
                'status' => 'success',
                'message' => 'Poster berhasil dibuat',
                'url' => route('admin.poster-dakwah.index')
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

    public function deletePosterDakwah($galeri)
    {
        try {
            DB::beginTransaction();
            $thumbnailOld = $galeri->filename;
            if ($thumbnailOld)
                Storage::delete('posterDakwah/' . $thumbnailOld);
            $galeri->delete();

            DB::commit();
            $response = [
                'status_code' => 200,
                'status' => 'success',
                'message' => 'Data berhasil dihapus',
                'url' => route('admin.poster-dakwah.index')
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
