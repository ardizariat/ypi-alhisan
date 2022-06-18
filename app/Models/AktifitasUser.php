<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AktifitasUser extends Model
{
    use HasFactory;

    protected $table = 'aktifitas_user',
        $fillable = [
            'nama',
            'aktifitas'
        ];
}
