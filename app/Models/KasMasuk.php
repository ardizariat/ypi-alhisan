<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KasMasuk extends Model
{
    use HasFactory;

    protected $table = 'kas_masuk',
        $fillable = [
            'dari',
            'nominal',
            'keterangan',
            'tanggal',
            'bukti_pembayaran'
        ];
}
