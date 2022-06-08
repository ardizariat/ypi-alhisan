<?php

use App\Models\ActivityLog;
use App\Models\KamarPasien;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Support\Facades\Auth;
use Nasution\Terbilang;

function usia($tanggal_lahir)
{
    $birthDate = new DateTime($tanggal_lahir);
    $today = Carbon::today();
    if ($birthDate > $today) {
        return false;
    }
    $y = $today->diff($birthDate)->y;
    $m = $today->diff($birthDate)->m;
    $d = $today->diff($birthDate)->d;
    return $y . " Tahun " . $m . " Bulan " . $d . " Hari";
}

function activeClass(string $route)
{
    return request()->routeIs($route) ? 'active current-page' : '';
}

function getInitialUser(string $nama)
{
    $arr = explode(' ', $nama);
    $singkatan = '';
    foreach ($arr as $kata) {
        $singkatan .= substr($kata, 0, 1);
    }
    return $singkatan;
}

function formatAngka(int $angka)
{
    return number_format($angka, 0, ',', '.');
}

function rp(int $angka)
{
    return 'Rp. ' . number_format($angka, 2, ',', '.');
}
function tanggal($tanggal)
{
    if ($tanggal == null) {
        return false;
    }
    $bulan = array(
        1 =>   'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    );
    $pecahkan = explode('-', $tanggal);

    return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
}

function tanggalJam($tanggal)
{
    return Carbon::parse($tanggal)->format('d M Y H:i');
}

function replaceRole($role)
{
    return Str::title(str_replace("_", " ", $role));
}

function activeClassFrontend($url)
{
    $currentUrl = url()->current();
    if ($url === $currentUrl) {
        return 'active';
    }
    return  '';
}

function prefixAPI()
{
    if (env('APP_ENV') === 'production') {
        return 'https://ypi-alhisan.herokuapp.com/api';
    } else {
        return 'http://alhisan.test/api';
    }
}
