<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RapatYayasan extends Model
{
    use HasFactory;
    protected $table = 'rapat_yayasan',
        $fillable = [
            'kode',
            'tanggal',
            'bahasan',
            'hasil'
        ];
}
