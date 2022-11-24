<?php

namespace App\Repositories;

use App\Models\PengurusYayasan;
use App\Models\StrukturOrganisasi;
use App\Models\User;
use App\Repositories\Interface\PengurusYayasanInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PengurusYayasanRepository implements PengurusYayasanInterface
{
    public $defaultPassword = 'alhisan';

    public function daftarPengurusYayasan($request = '')
    {
        $pengurus = DB::table('pengurus_yayasan as py')
            ->selectRaw('py.nama, py.status')
            ->when(
                $request ?? false,
                fn ($query) =>
                $query->where('py.nama', 'LIKE', '%' . $request . '%')
                    ->orWhere('py.status', 'LIKE', '%' . $request . '%')
            )
            ->where('status', 'aktif')
            ->orderBy('py.nama')
            ->get();

        return $pengurus;
    }

    public function daftarPengurusYayasanAdmin()
    {
        return DB::table('struktur_organisasi as so')
            ->selectRaw('py.id, py.nama, b.nama as bagian, py.status')
            ->join('pengurus_yayasan as py', 'so.pengurus_yayasan_id', '=', 'py.id')
            ->join('bagian as b', 'b.id', '=', 'so.bagian_id')
            ->orderBy('py.nama');
    }

    public function pengurusYayasanDetail($pengurusYayasanId)
    {
        return DB::table('struktur_organisasi as so')
            ->selectRaw('py.id, py.nama, b.nama as bagian, b.id as bagian_id, py.foto')
            ->join('pengurus_yayasan as py', 'so.pengurus_yayasan_id', '=', 'py.id')
            ->join('bagian as b', 'b.id', '=', 'so.bagian_id')
            ->where('so.pengurus_yayasan_id', $pengurusYayasanId)
            ->where('py.id', $pengurusYayasanId)
            ->first();
    }

    public function strukturOrganisasi()
    {
        return DB::table('struktur_organisasi as so')
            ->join('bagian as b', 'b.id', '=', 'so.bagian_id')
            ->join('pengurus_yayasan as py', 'py.id', '=', 'so.pengurus_yayasan_id')
            ->selectRaw('so.id, py.nama, b.nama as bagian, py.foto')
            ->orderBy('so.id')
            ->where('so.status', 'aktif')
            ->get();
    }

    public function storePengurusYayasan($request)
    {
        try {
            DB::beginTransaction();

            $pengurusYayasan = new PengurusYayasan();
            $pengurusYayasan->nama = $request->nama;
            if ($request->hasFile('foto')) {
                $filename = uploadFile($request->file('foto'), 'pengurusYayasan/');
                $pengurusYayasan->foto = $filename;
            }
            $pengurusYayasan->save();

            $strukturOrganisasi = new StrukturOrganisasi();
            $strukturOrganisasi->pengurus_yayasan_id = $pengurusYayasan->id;
            $strukturOrganisasi->bagian_id = $request->bagian_id;
            $strukturOrganisasi->save();

            DB::commit();
            $response = [
                'status_code' => 201,
                'status' => 'success',
                'message' => 'Data berhasil dibuat',
                'url' => route('admin.pengurus-yayasan.index')
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

    public function updatePengurusYayasan($pengurusYayasan, $request)
    {
        try {
            DB::beginTransaction();

            $strukturOrganisasi = StrukturOrganisasi::where('pengurus_yayasan_id', $pengurusYayasan->id)->first();

            $pengurusYayasan = PengurusYayasan::find($strukturOrganisasi->pengurus_yayasan_id);
            $pengurusYayasan->nama = $request->nama;
            if ($request->hasFile('foto')) {
                $fotoOld = $pengurusYayasan->foto;
                if ($fotoOld)
                    Storage::delete('pengurusYayasan/' . $fotoOld);
                $filename = uploadFile($request->file('foto'), 'pengurusYayasan/');
                $pengurusYayasan->foto = $filename;
            }
            $pengurusYayasan->update();

            $strukturOrganisasi->pengurus_yayasan_id = $pengurusYayasan->id;
            $strukturOrganisasi->bagian_id = $request->bagian_id;
            $strukturOrganisasi->update();

            DB::commit();
            $response = [
                'status_code' => 200,
                'status' => 'success',
                'message' => 'Data berhasil diupdate',
                'url' => route('admin.pengurus-yayasan.index')
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

    public function deletePengurusYayasan($pengurusYayasan)
    {
        try {
            DB::beginTransaction();
            $strukturOrganisasi = StrukturOrganisasi::where('pengurus_yayasan_id', $pengurusYayasan->id)->first();
            $user = User::find($pengurusYayasan->user_id);

            $fotoOld = $pengurusYayasan->foto;
            if ($fotoOld)
                Storage::delete('pengurusYayasan/' . $fotoOld);

            $strukturOrganisasi->delete();
            $user->delete();
            $pengurusYayasan->delete();

            DB::commit();
            $response = [
                'status_code' => 200,
                'status' => 'success',
                'message' => 'Data berhasil dihapus',
                'url' => route('admin.pengurus-yayasan.index')
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
