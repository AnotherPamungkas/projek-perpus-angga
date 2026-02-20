<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BukuFavorit extends Model
{
    protected $table = 'buku_favorit';

    protected $fillable = [
        'peminjam_id',
        'buku_id',
    ];

    public function peminjam()
    {
        return $this->belongsTo(User::class, 'peminjam_id');
    }

    public function buku()
    {
        return $this->belongsTo(Buku::class, 'buku_id');
    }
}
