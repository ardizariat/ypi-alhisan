<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PesertaRapatYayasan extends Model
{
    use HasFactory;
    protected $table = 'peserta_rapat_yayasan',
        $fillable = [
            'rapat_yayasan_id',
            'user_id'
        ];
}
