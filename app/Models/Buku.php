<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    protected $fillable = [
        'cover', 
        'judul_buku',
        'pengarang',
        'penerbit',
        'tahun_terbit',
        'kategori_id',
        'jumlah_buku',
        'deskripsi',
        'status'
    ];
}
