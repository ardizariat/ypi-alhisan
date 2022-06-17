<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;
    protected $table = 'profiles',
        $fillable = [
            'user_id',
            'tempat_lahir',
            'tanggal_lahir',
            'jenis_kelamin',
            'foto',
            'no_hp',
            'alamat',
        ];
}
