<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alhisan extends Model
{
    use HasFactory;

    protected $table = 'alhisan',
        $fillable = [
            'nama',
            'logo',
            'email',
            'no_hp',
            'no_telpon',
            'visi',
            'misi',
            'tujuan',
            'alamat',
            'sejarah'
        ];
}
