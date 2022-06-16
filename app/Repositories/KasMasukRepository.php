<?php

namespace App\Repositories;

use App\Models\KasMasuk;
use App\Repositories\Interface\KasMasukInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class KasMasukRepository implements KasMasukInterface
{
    public function kasMasukAdmin()
    {
        return DB::table('kas_masuk as km')
            ->selectRaw('
            km.*
        ')
            ->orderByDesc('km.tanggal');
    }

    public function storeKasMasuk($request)
    {
        try {
            DB::beginTransaction();
            $kasMasuk = new KasMasuk();
            $kasMasuk->dari = $request->dari;
            $kasMasuk->tanggal = $request->tanggal;
            $kasMasuk->nominal = $request->nominal;
            $kasMasuk->keterangan = $request->keterangan;
            $kasMasuk->save();

            DB::commit();
            $response = [
                'status_code' => 201,
                'status' => 'success',
                'message' => 'Data berhasil dibuat',
                'url' => route('admin.kas-masuk.index')
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

    public function updateKasMasuk($kasMasuk, $request)
    {
        try {
            DB::beginTransaction();
            $kasMasuk->dari = $request->dari;
            $kasMasuk->tanggal = $request->tanggal;
            $kasMasuk->nominal = $request->nominal;
            $kasMasuk->keterangan = $request->keterangan;
            $kasMasuk->update();

            DB::commit();
            $response = [
                'status_code' => 200,
                'status' => 'success',
                'message' => 'Data berhasil diupdate',
                'url' => route('admin.kas-masuk.index')
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

    public function deleteKasMasuk($kasMasuk)
    {
        try {
            DB::beginTransaction();

            $kasMasuk->delete();

            DB::commit();
            $response = [
                'status_code' => 200,
                'status' => 'success',
                'message' => 'Data berhasil dihapus',
                'url' => route('admin.kas-masuk.index')
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
