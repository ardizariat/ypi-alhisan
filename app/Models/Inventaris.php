<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventaris extends Model
{
    use HasFactory;

    protected $table = 'inventaris',
        $fillable = [
            'kode',
            'nama',
            'kategori_id',
            'jumlah',
            'keadaan',
            'keterangan',
            'tahun_pembelian',
            'harga_beli_satuan',
            'foto',
        ];
}
