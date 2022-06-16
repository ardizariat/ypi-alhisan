<?php

namespace App\Repositories;

use App\Models\KalimatHikmah;
use App\Repositories\Interface\KalimatHikmahInterface;
use Illuminate\Support\Facades\DB;

class KalimatHikmahRepository implements KalimatHikmahInterface
{
    public function kalimatHikmahAdmin()
    {
        return DB::table('kalimat_hikmah as k')
            ->selectRaw('k.id, k.penulis, k.text, k.created_at')
            ->orderByDesc('k.created_at');
    }

    public function kalimatHikmah()
    {
        return DB::table('kalimat_hikmah as k')
            ->selectRaw('k.id, k.penulis, k.text, k.created_at')
            ->orderByDesc('k.created_at')
            ->limit(20)
            ->get();
    }

    public function storeKalimatHikmah($request)
    {
        try {
            DB::beginTransaction();
            $kalimatHikmah = new KalimatHikmah();
            $kalimatHikmah->penulis = $request->penulis;
            $kalimatHikmah->text = $request->text;
            $kalimatHikmah->save();

            DB::commit();
            $response = [
                'status_code' => 201,
                'status' => 'success',
                'message' => 'Data berhasil dibuat',
                'url' => route('admin.kalimat-hikmah.index')
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

    public function updateKalimatHikmah($kalimatHikmah, $request)
    {
        try {
            DB::beginTransaction();
            $kalimatHikmah->penulis = $request->penulis;
            $kalimatHikmah->text = $request->text;
            $kalimatHikmah->update();

            DB::commit();
            $response = [
                'status_code' => 200,
                'status' => 'success',
                'message' => 'Data berhasil diupdate',
                'url' => route('admin.kalimat-hikmah.index')
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

    public function deleteKalimatHikmah($kalimatHikmah)
    {
        try {
            DB::beginTransaction();

            $kalimatHikmah->delete();

            DB::commit();
            $response = [
                'status_code' => 200,
                'status' => 'success',
                'message' => 'Data berhasil dihapus',
                'url' => route('admin.kalimat-hikmah.index')
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
