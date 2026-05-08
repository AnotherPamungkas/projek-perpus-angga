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

    public function buku()
    {
        return $this->belongsTo(Buku::class, 'buku_id');
    }

    public function peminjam()
    {
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

    public function denda()
    {
        return $this->hasOne(Denda::class, 'peminjaman_id')
            ->latestOfMany();
    }

    public function getHariTerlambatAttribute()
    {
        if ($this->tanggal_kembali) {
            return 0;
        }

        if (now()->lessThanOrEqualTo($this->tanggal_jatuh_tempo)) {
            return 0;
        }

        return now()->diffInDays($this->tanggal_jatuh_tempo);
    }

    public function generateDenda()
    {
        if ($this->status !== 'terlambat') {
            return;
        }

        $hariTerlambat = now()->diffInDays($this->tanggal_jatuh_tempo);
        $tarif = config('library.denda_per_hari');

        $this->update([
            'denda' => $hariTerlambat * $tarif,
            'status_pembayaran' => 'belum_bayar'
        ]);
    }

    public function syncKeterlambatan()
    {
        if (
            !$this->tanggal_kembali &&
            now()->startOfDay()->gt(
                Carbon::parse($this->tanggal_jatuh_tempo)->startOfDay()
            )
        ) {
            $hariTerlambat = Carbon::parse($this->tanggal_jatuh_tempo)
                ->startOfDay()
                ->diffInDays(now()->startOfDay());

            $tarif = (int) config('library.denda_per_hari');

            $totalDenda = $hariTerlambat * $tarif;

            $data = [
                'status' => 'terlambat',
                'denda' => $totalDenda,
            ];

            // hanya set belum_bayar jika memang belum pernah bayar
            if ($this->status_pembayaran !== 'sudah_bayar') {
                $data['status_pembayaran'] = 'belum_bayar';
            }

            $this->update($data);
        }
    }
}
