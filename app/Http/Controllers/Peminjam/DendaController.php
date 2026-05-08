<?php

namespace App\Http\Controllers\Peminjam;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Peminjaman;
use Illuminate\Support\Str;
use App\Models\Denda;


class DendaController extends Controller
{
    public function createInvoice($peminjamanId)
    {
        $user = Auth::user();

        $peminjaman = Peminjaman::with('denda')
            ->where('id', $peminjamanId)
            ->where('user_id', $user->id)
            ->firstOrFail();

        if ($peminjaman->hari_terlambat <= 0) {
            return back()->with('error', 'Buku belum terlambat');
        }

        if ($peminjaman->denda && $peminjaman->denda->status === 'pending') {
            return redirect()->route(
                'denda.payment',
                $peminjaman->denda->qr_token
            );
        }

        $hariTerlambat = $peminjaman->hari_terlambat;
        $tarif = config('library.denda_per_hari');
        $nominal = $hariTerlambat * $tarif;

        $denda = Denda::create([
            'peminjaman_id' => $peminjaman->id,
            'user_id' => $user->id,
            'nominal' => $nominal,
            'hari_terlambat' => $hariTerlambat,
            'tarif_per_hari' => $tarif,
            'kode_invoice' => 'DND-' . now()->format('YmdHis'),
            'qr_token' => Str::uuid(),
            'status' => 'pending'
        ]);

        return redirect()->route(
            'denda.payment',
            $denda->qr_token
        );
    }

    public function payment($token)
    {
        $denda = Denda::with([
            'peminjaman.buku',
            'user'
        ])
            ->where('qr_token', $token)
            ->firstOrFail();

        return view('peminjam.denda.payment', compact('denda'));
    }

    public function simulatePayment($token)
    {
        $denda = Denda::where('qr_token', $token)
            ->firstOrFail();

        if ($denda->status === 'paid') {
            return back()->with('info', 'Denda sudah dibayar');
        }

        $denda->update([
            'status' => 'paid',
            'paid_at' => now()
        ]);

        return redirect()
            ->route('dashboard.peminjam')
            ->with('success', 'Pembayaran berhasil');
    }

    public function showInvoice($id)
{
    $user = Auth::user();

    $denda = Denda::with([
        'peminjaman.buku'
    ])
    ->where('id', $id)
    ->where('user_id', $user->id)
    ->firstOrFail();

    return view('peminjam.denda.show', compact('denda'));
}
}
