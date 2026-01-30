<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    protected $table = 'buku'; 
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

    public function kategori()
{
    return $this->belongsTo(Kategori::class);
}

public function peminjaman() {
    return $this->hasMany(Peminjaman::class, 'buku_id');
}


}
