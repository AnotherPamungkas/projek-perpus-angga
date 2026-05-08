<?php

namespace App\Http\Controllers\Peminjam;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use App\Models\Denda;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class PembayaranDendaController extends Controller
{
    public function show(Peminjaman $peminjaman)
    {
        abort_if(
            $peminjaman->peminjam_id !== Auth::id(),
            403
        );

        return view(
            'peminjam.pembayaran.show',
            compact('peminjaman')
        );
    }

    public function bayar(Peminjaman $peminjaman)
    {
        abort_if(
            $peminjaman->peminjam_id !== Auth::id(),
            403
        );

        if ($peminjaman->status_pembayaran === 'sudah_bayar') {
            return back()->with(
                'error',
                'Denda sudah dibayar.'
            );
        }

        Denda::updateOrCreate(
            [
                'peminjaman_id' => $peminjaman->id,
            ],
            [
                'user_id' => Auth::id(),
                'nominal' => $peminjaman->denda,
                'hari_terlambat' => $peminjaman->hari_terlambat,
                'tarif_per_hari' => config('library.denda_per_hari'),
                'kode_invoice' => 'INV-' . strtoupper(Str::random(10)),
                'qr_token' => Str::uuid(),
                'status' => 'paid',
                'paid_at' => now(),
            ]
        );

        $peminjaman->update([
            'status_pembayaran' => 'sudah_bayar'
        ]);

        return redirect()
            ->route('peminjam.dashboard')
            ->with(
                'success',
                'Pembayaran berhasil dilakukan.'
            );
    }
}
