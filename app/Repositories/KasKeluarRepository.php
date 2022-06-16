<?php

namespace App\Repositories;

use App\Models\KasKeluar;
use App\Repositories\Interface\KasKeluarInterface;
use Illuminate\Support\Facades\DB;

class KasKeluarRepository implements KasKeluarInterface
{
    public function kasKeluarAdmin()
    {
        return DB::table('kas_keluar as kk')
            ->selectRaw('
            kk.*
        ')
            ->orderByDesc('kk.tanggal');
    }

    public function storeKasKeluar($request)
    {
        try {
            DB::beginTransaction();
            $kasKeluar = new KasKeluar();
            $kasKeluar->untuk = $request->untuk;
            $kasKeluar->tanggal = $request->tanggal;
            $kasKeluar->nominal = $request->nominal;
            $kasKeluar->keterangan = $request->keterangan;
            $kasKeluar->save();

            DB::commit();
            $response = [
                'status_code' => 201,
                'status' => 'success',
                'message' => 'Data berhasil dibuat',
                'url' => route('admin.kas-keluar.index')
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

    public function updateKasKeluar($kasKeluar, $request)
    {
        try {
            DB::beginTransaction();
            $kasKeluar->untuk = $request->untuk;
            $kasKeluar->tanggal = $request->tanggal;
            $kasKeluar->nominal = $request->nominal;
            $kasKeluar->keterangan = $request->keterangan;
            $kasKeluar->update();

            DB::commit();
            $response = [
                'status_code' => 200,
                'status' => 'success',
                'message' => 'Data berhasil diupdate',
                'url' => route('admin.kas-keluar.index')
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

    public function deleteKasKeluar($kasKeluar)
    {
        try {
            DB::beginTransaction();

            $kasKeluar->delete();

            DB::commit();
            $response = [
                'status_code' => 200,
                'status' => 'success',
                'message' => 'Data berhasil dihapus',
                'url' => route('admin.kas-keluar.index')
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

    public function dataLaporanKasKeluar($dari, $sampai)
    {
        return DB::table('kas_keluar as kk')
            ->whereBetween('kk.tanggal', [$dari, $sampai])
            ->orderByDesc('kk.tanggal')
            ->get();
    }
}
