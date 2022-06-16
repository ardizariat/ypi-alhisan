<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KalimatHikmah extends Model
{
    use HasFactory;

    protected $table = 'kalimat_hikmah',
        $fillable = [
            'text',
            'penulis',
            'status',
        ];
}
