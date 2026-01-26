<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ulasan extends Model
{
    protected $fillable = [
        'buku_id',
        'siswa_id',
        'isi_ulasan',
        'rating'
    ];
}
