<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    protected $table = 'peminjaman';

    protected $fillable = [
        'buku_id',
        'peminjam_id',
        'tanggal_pinjam',
        'tanggal_jatuh_tempo',
        'jumlah_dipinjam',
        'tanggal_kembali',
        'status',
        'validated_by',
        'validated_at',
        'alasan_penolakan',
        'denda',
        'status_pembayaran',
    ];

    protected $casts = [
        'tanggal_pinjam' => 'datetime',
        'tanggal_jatuh_tempo' => 'datetime',
        'tanggal_kembali' => 'datetime',
    ];

    public function buku() {
        return $this->belongsTo(Buku::class, 'buku_id');
    }

    public function peminjam() {
        return $this->belongsTo(User::class, 'peminjam_id');
    }

    public function checkKeterlambatan()
{
    if (
        $this->status === 'dipinjam' &&
        $this->tanggal_kembali === null &&
        Carbon::now()->greaterThan($this->tanggal_jatuh_tempo)
    ) {
        $this->status = 'terlambat'; // fixed penalty
        $this->save();
    }
}
}

