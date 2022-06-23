<?php

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
    return 'Rp. ' . number_format($angka, 0, ',', '.');
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
    if (env('APP_ENV') != 'local') {
        return 'https://ypi-alhisan.herokuapp.com/api';
    }
    return 'http://alhisan.test/api';
}

function kode(string $table, string $field, int $panjang, string $prefix, bool $auto_reset = true)
{
    $config = [
        'table' => $table,
        'field' => $field,
        'length' => $panjang,
        'prefix' => $prefix,
        'reset_on_prefix_change' => $auto_reset
    ];
    return IdGenerator::generate($config);
}

function terbilangRupiah($angka)
{
    $terbilang = new Terbilang();
    return $terbilang->convert((int)$angka) . ' Rupiah';
}

function kodeRapatYayasan()
{
    $prefix = date('d');
    return kode('rapat_yayasan', 'kode', '7', 'ypi' . $prefix);
}

function kodeBarangInventaris()
{
    return kode('inventaris', 'kode', '13', 'YPI-BRG-');
}

function tanggalJamSekarang()
{
    return now()->toDateTimeLocalString();
}

function tanggalSekarang()
{
    return now()->toDateString();
}

function uploadFile($file, string $path)
{
    $extension = $file->getClientOriginalExtension();
    $filename = time() . '_' . uniqid() . '.' . $extension;
    $path = $file->storeAs($path, $filename);
    return $filename;
}

function alhisan()
{
    return DB::table('alhisan as a')
        ->selectRaw('a.*')
        ->first();
}

function saldoKas()
{
    $kasMasuk = DB::table('kas_masuk as km')
        ->select('km.nominal')
        ->get();
    $totalKasMasuk = $kasMasuk->sum('nominal');

    $kasKeluar = DB::table('kas_keluar as kk')
        ->select('kk.nominal')
        ->get();
    $totalKasKeluar = $kasKeluar->sum('nominal');

    return $totalKasMasuk - $totalKasKeluar;
}

function activity(string $aktifitas)
{
    if (!Auth::check()) {
        return false;
    }
    $user = auth()->user();
    DB::table('aktifitas_user')->insert([
        'nama' => $user->name,
        'aktifitas' => $aktifitas,
        'created_at' => tanggalJamSekarang()
    ]);
}
