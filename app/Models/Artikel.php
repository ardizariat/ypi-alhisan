<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artikel extends Model
{
    use HasFactory;
    protected $table = 'artikel',
        $fillable = [
            'kategori_artikel_id',
            'slug',
            'judul',
            'konten',
            'thumbnail',
            'status',
            'user_id',
            'dilihat',
            'dipublikasi'
        ];
}
