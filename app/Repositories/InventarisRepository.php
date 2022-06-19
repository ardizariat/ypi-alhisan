<?php

namespace App\Repositories;

use App\Models\Inventaris;
use App\Repositories\Interface\InventarisInterface;
use Illuminate\Support\Facades\DB;
use Storage;

class InventarisRepository implements InventarisInterface
{
    public function inventarisAdmin()
    {
        return DB::table('inventaris as i')
            ->leftJoin('kategori as k', 'k.id', '=', 'i.kategori_id')
            ->selectRaw('
            i.id, i.kode, i.nama, i.kategori_id, i.harga_beli_satuan, i.jumlah, i.keadaan, i.keterangan, i.tahun_pembelian, i.foto, k.nama as kategori
        ')
            ->orderBy('i.nama');
    }

    public function eksporDataInventaris()
    {
        return DB::table('inventaris as i')
            ->leftJoin('kategori as k', 'k.id', '=', 'i.kategori_id')
            ->selectRaw('
            i.id, i.kode, i.nama, i.kategori_id, i.harga_beli_satuan, i.jumlah, i.keadaan, i.keterangan, i.tahun_pembelian, i.foto, k.nama as kategori
        ')
            ->orderBy('i.nama')
            ->get();
    }

    public function kategoriInventaris()
    {
        return DB::table('kategori as k')
            ->selectRaw("k.nama, k.slug, k.id")
            ->where('k.kategori', 'inventaris')
            ->get();
    }

    public function detailInventarisAdmin($inventarisId)
    {
        return DB::table('inventaris as i')
            ->leftJoin('kategori as k', 'k.id', '=', 'i.kategori_id')
            ->selectRaw('
            i.id, i.kode, i.nama, i.kategori_id, i.harga_beli_satuan, i.jumlah, i.keadaan, i.keterangan, i.tahun_pembelian, i.foto, k.nama as kategori
        ')
            ->where('i.id', $inventarisId)
            ->first();
    }

    public function storeInventaris($request)
    {
        try {
            DB::beginTransaction();

            $inventaris = new Inventaris();
            $inventaris->nama = $request->nama;
            $inventaris->kode = kodeBarangInventaris();
            $inventaris->kategori_id = $request->kategori_id;
            $inventaris->harga_beli_satuan = $request->harga_beli_satuan;
            $inventaris->jumlah = $request->jumlah;
            $inventaris->keadaan = $request->keadaan;
            $inventaris->tahun_pembelian = $request->tahun_pembelian;
            $inventaris->keterangan = $request->keterangan;
            if ($request->hasFile('foto')) {
                $filename = uploadFile($request->file('foto'), 'inventaris/');
                $inventaris->foto = $filename;
            }
            $inventaris->save();

            DB::commit();
            $response = [
                'status_code' => 201,
                'status' => 'success',
                'message' => 'Data berhasil dibuat',
                'url' => route('admin.inventaris.index')
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

    public function updateInventaris($inventaris, $request)
    {
        try {
            DB::beginTransaction();
            $inventaris->nama = $request->nama;
            $inventaris->kategori_id = $request->kategori_id;
            $inventaris->harga_beli_satuan = $request->harga_beli_satuan;
            $inventaris->jumlah = $request->jumlah;
            $inventaris->keadaan = $request->keadaan;
            $inventaris->tahun_pembelian = $request->tahun_pembelian;
            $inventaris->keterangan = $request->keterangan;
            if ($request->hasFile('foto')) {
                $fotoOld = $inventaris->foto;
                if ($fotoOld)
                    Storage::delete('inventaris/' . $fotoOld);
                $filename = uploadFile($request->file('foto'), 'inventaris/');
                $inventaris->thumbnail = $filename;
            }
            $inventaris->update();

            DB::commit();
            $response = [
                'status_code' => 200,
                'status' => 'success',
                'message' => 'Data berhasil diupdate',
                'url' => route('admin.inventaris.index')
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

    public function deleteInventaris($inventaris)
    {
        try {
            DB::beginTransaction();
            $thumbnailOld = $inventaris->foto;
            if ($thumbnailOld)
                Storage::delete('inventaris/' . $thumbnailOld);
            $inventaris->delete();

            DB::commit();
            $response = [
                'status_code' => 200,
                'status' => 'success',
                'message' => 'Data berhasil dihapus',
                'url' => route('admin.inventaris.index')
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
