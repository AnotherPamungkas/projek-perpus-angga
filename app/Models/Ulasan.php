<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ulasan extends Model
{
    protected $table = 'ulasan';

    protected $fillable = [
        'buku_id',
        'peminjam_id',
        'isi_ulasan',
        'rating'
    ];

    public function buku() {
        return $this->belongsTo(Buku::class, 'buku_id');
    }

    public function peminjam() {
        return $this->belongsTo(User::class, 'peminjam_id');
    }
}
