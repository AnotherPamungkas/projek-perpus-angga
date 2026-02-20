<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profil extends Model
{
    protected $table = 'profil';

    protected $fillable = [
        'peminjam_id',
        'nomor_telepon',
        'alamat'
    ];

    public function peminjam() {
        return $this->belongsTo(User::class, 'peminjam_id');
    }
}
