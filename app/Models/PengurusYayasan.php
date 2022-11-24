<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengurusYayasan extends Model
{
    use HasFactory;

    protected $table = 'pengurus_yayasan',
        $fillable = [
            'nama',
            'foto',
            'status',
        ];
}
