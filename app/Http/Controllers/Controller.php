<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function statusArtikel()
    {
        $status = ['dipublikasi', 'draft'];
        return $status;
    }

    public function statusInventaris()
    {
        $status = ['baik', 'rusak'];
        return $status;
    }

    public function roles()
    {
        return DB::table('roles as r')->selectRaw('r.id, r.name')->get();
    }

    public function permissions()
    {
        return DB::table('permissions as p')->selectRaw('p.id, p.name')->get();
    }

    public function bagian()
    {
        return DB::table('bagian as b')->selectRaw('b.id, b.nama')->get();
    }
}
