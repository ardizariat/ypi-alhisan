<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StrukturOrganisasi extends Model
{
    use HasFactory;

    protected $table = 'struktur_organisasi',
        $fillable = [
            'pengurus_yayasan_id',
            'bagian_id',
            'status'
        ];
}
