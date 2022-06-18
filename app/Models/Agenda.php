<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    use HasFactory;

    protected $table = 'agenda',
        $fillable = [
            'rapat_yayasan_id',
            'tanggal',
            'keterangan',
        ];
}
