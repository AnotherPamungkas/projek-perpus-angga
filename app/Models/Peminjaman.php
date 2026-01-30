<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    protected $table = 'peminjaman';

    protected $fillable = [
        'buku_id',
        'siswa_id',
        'tanggal_pinjam',
        'tanggal_jatuh_tempo',
        'tanggal_kembali',
        'status'
    ];

    public function buku() {
        return $this->belongsTo(Buku::class, 'buku_id');
    }

    public function siswa() {
        return $this->belongsTo(User::class, 'siswa_id');
    }
}
