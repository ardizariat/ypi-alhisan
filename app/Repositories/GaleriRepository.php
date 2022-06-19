<?php

namespace App\Repositories;

use App\Models\Galeri;
use App\Repositories\Interface\GaleriInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class GaleriRepository implements GaleriInterface
{
    public $kategoriPosterDakwah = 1;

    //-------------- Galeri --------------//
    public function galeriAdmin()
    {
        return DB::table('galeri as g')
            ->selectRaw('g.*')
            ->whereNotIn('g.kategori_id', [$this->kategoriPosterDakwah])
            ->orWhereNull('g.kategori_id')
            ->orderByDesc('g.created_at');
    }

    public function galeriApp()
    {
        return DB::table('galeri as g')
            ->selectRaw('g.*')
            ->whereNotIn('g.kategori_id', [$this->kategoriPosterDakwah])
            ->orWhereNull('g.kategori_id')
            ->orderByDesc('g.created_at');
    }

    public function storeGaleri($request)
    {
        try {
            DB::beginTransaction();

            $posterDakwah = new Galeri();
            $posterDakwah->keterangan = $request->keterangan;
            if ($request->hasFile('filename')) {
                $filename = uploadFile($request->file('filename'), 'galeri/');
                $posterDakwah->filename = $filename;
            }
            $posterDakwah->save();

            DB::commit();
            $response = [
                'status_code' => 201,
                'status' => 'success',
                'message' => 'Galeri berhasil dibuat',
                'url' => route('admin.galeri.index')
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

    public function deleteGaleri($galeri)
    {
        try {
            DB::beginTransaction();
            $thumbnailOld = $galeri->filename;
            if ($thumbnailOld)
                Storage::delete('galeri/' . $thumbnailOld);
            $galeri->delete();

            DB::commit();
            $response = [
                'status_code' => 200,
                'status' => 'success',
                'message' => 'Data berhasil dihapus',
                'url' => route('admin.galeri.index')
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

    //-------------- Poster dakwah --------------//
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
