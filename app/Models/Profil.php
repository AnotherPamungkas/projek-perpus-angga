<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profil extends Model
{
    protected $fillable = [
        'siswa_id', 
        'nomor_telepon',
        'alamat'
    ];
}
