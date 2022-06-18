<?php

namespace App\Repositories;

use App\Models\Agenda;
use App\Models\RapatYayasan;
use App\Repositories\Interface\AgendaInterface;
use Illuminate\Support\Facades\DB;

class AgendaRepository implements AgendaInterface
{
    public function agendaAdmin()
    {
        return DB::table('agenda as a')
            ->leftJoin('rapat_yayasan as ry', 'ry.id', '=', 'a.rapat_yayasan_id')
            ->selectRaw('
            a.*
        ')
            ->orderByDesc('a.tanggal');
    }

    public function storeAgenda($request)
    {
        try {
            DB::beginTransaction();
            $agenda = new Agenda();
            $agenda->tanggal = $request->tanggal;
            $agenda->keterangan = $request->keterangan;
            $agenda->save();

            DB::commit();
            $response = [
                'status_code' => 201,
                'status' => 'success',
                'message' => 'Data berhasil dibuat',
                'url' => route('admin.agenda.index')
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

    public function updateAgenda($agenda, $request)
    {
        try {
            DB::beginTransaction();
            $rapatYayasan = RapatYayasan::find($agenda->rapat_yayasan_id);
            if ($rapatYayasan) {
                $rapatYayasan->tanggal = $request->tanggal;
                $rapatYayasan->bahasan = $request->keterangan;
                $rapatYayasan->update();
            }
            $agenda->tanggal = $request->tanggal;
            $agenda->keterangan = $request->keterangan;
            $agenda->update();

            DB::commit();
            $response = [
                'status_code' => 200,
                'status' => 'success',
                'message' => 'Data berhasil diupdate',
                'url' => route('admin.agenda.index')
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

    public function deleteAgenda($agenda)
    {
        try {
            DB::beginTransaction();
            $rapatYayasan = RapatYayasan::find($agenda->rapat_yayasan_id);
            if ($rapatYayasan)
                $rapatYayasan->delete();
            $agenda->delete();

            DB::commit();
            $response = [
                'status_code' => 200,
                'status' => 'success',
                'message' => 'Data berhasil dihapus',
                'url' => route('admin.agenda.index')
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
