<?php

namespace App\Repositories;

use App\Models\Agenda;
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

    public function storeRapatYayasan($request)
    {
        try {
            DB::beginTransaction();
            $rapatYayasan = DB::table('rapat_yayasan')->insertGetId([
                'kode' => kodeRapatYayasan(),
                'tanggal' => $request->tanggal,
                'bahasan' => $request->bahasan,
                'created_at' => tanggalJamSekarang()
            ]);

            $agenda = new Agenda();
            $agenda->rapat_yayasan_id = $rapatYayasan;
            $agenda->tanggal = $request->tanggal;
            $agenda->keterangan = 'rapat yayasan';
            $agenda->save();

            DB::commit();

            $response = [
                'status_code' => 201,
                'status' => 'success',
                'message' => 'Data berhasil dibuat',
                'url' => route('admin.rapat-yayasan.index')
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

    public function updateRapatYayasan($rapatYayasan, $request)
    {
        try {
            DB::beginTransaction();
            $agenda = Agenda::where('rapat_yayasan_id', $rapatYayasan->id)->first();
            if ($agenda) {
                $agenda->tanggal = $request->tanggal ?? $agenda->tanggal;
                $agenda->keterangan = 'rapat yayasan';
                $agenda->update();
            }
            $rapatYayasan->tanggal = $request->tanggal ?? $rapatYayasan->tanggal;
            $rapatYayasan->bahasan = $request->bahasan ?? $rapatYayasan->bahasan;
            $rapatYayasan->hasil = $request->hasil ?? $rapatYayasan->hasil;
            $rapatYayasan->update();

            DB::commit();
            $response = [
                'status_code' => 200,
                'status' => 'success',
                'message' => 'Data berhasil diupdate',
                'url' => route('admin.rapat-yayasan.index')
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

    public function deleteRapatYayasan($rapatYayasan)
    {
        try {
            DB::beginTransaction();
            $agenda = Agenda::where('rapat_yayasan_id', $rapatYayasan->id)->first();
            if ($agenda)
                $agenda->delete();
            $rapatYayasan->delete();

            DB::commit();
            $response = [
                'status_code' => 200,
                'status' => 'success',
                'message' => 'Data berhasil dihapus',
                'url' => route('admin.rapat-yayasan.index')
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
