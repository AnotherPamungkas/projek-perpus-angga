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
        'created_by',
        'jumlah_buku',
        'deskripsi',
        'status',
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class, 'buku_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function favoritUsers()
    {
        return $this->belongsToMany(
            \App\Models\User::class,
            'buku_favorit',
            'buku_id',
            'peminjam_id'
        );
    }

    public function ulasan()
    {
        return $this->hasMany(Ulasan::class, 'buku_id');
    }
}
