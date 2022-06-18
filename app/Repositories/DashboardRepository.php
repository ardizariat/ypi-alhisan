<?php

namespace App\Repositories;

use App\Repositories\Interface\DashboardInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardRepository implements DashboardInterface
{
    public function startDayOfThisMonth()
    {
        $today = Carbon::now();
        return Carbon::parse($today)->startOfMonth()->toDateTimeString();
        $end = Carbon::parse($today)->endOfMonth()->toDateTimeString();
    }

    public function endDayOfThisMonth()
    {
        $today = Carbon::now();
        return Carbon::parse($today)->endOfMonth()->toDateTimeString();
    }

    public function agendaBulanIni()
    {
        return DB::table('agenda as a')
            ->leftJoin('rapat_yayasan as ry', 'ry.id', '=', 'a.rapat_yayasan_id')
            ->selectRaw('
            a.*
        ')
            ->whereBetween('a.tanggal', [$this->startDayOfThisMonth(), $this->endDayOfThisMonth()])
            ->get();
    }

    public function saldoKasBulanIni()
    {
        $kasMasuk = DB::table('kas_masuk as km')
            ->selectRaw('km.*')
            ->whereBetween('km.tanggal', [$this->startDayOfThisMonth(), $this->endDayOfThisMonth()])
            ->get();
        $kasMasuk = $kasMasuk->sum('nominal');

        $kasKeluar = DB::table('kas_keluar as kk')
            ->selectRaw('kk.*')
            ->whereBetween('kk.tanggal', [$this->startDayOfThisMonth(), $this->endDayOfThisMonth()])
            ->get();
        $kasKeluar = $kasKeluar->sum('nominal');

        $data = [
            'kas saat ini' => saldoKas(),
            'kas masuk' => $kasMasuk,
            'kas keluar' => $kasKeluar,
        ];

        return $data;
    }

    public function kasMasukKeluarBulanIni()
    {
        $kasMasuk = DB::table('kas_masuk as km')
            ->selectRaw('km.*')
            ->whereBetween('km.tanggal', [$this->startDayOfThisMonth(), $this->endDayOfThisMonth()])
            ->get();

        $kasKeluar = DB::table('kas_keluar as kk')
            ->selectRaw('kk.*')
            ->whereBetween('kk.tanggal', [$this->startDayOfThisMonth(), $this->endDayOfThisMonth()])
            ->get();

        $data = [
            'masuk' => $kasMasuk,
            'keluar' => $kasKeluar,
        ];

        return $data;
    }
}
