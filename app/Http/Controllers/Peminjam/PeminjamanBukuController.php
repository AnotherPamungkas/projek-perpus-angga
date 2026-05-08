<?php

namespace App\Http\Controllers\Peminjam;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use App\Models\Peminjaman;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PeminjamanBukuController extends Controller
{
    public function form(Buku $buku)
    {
        $profil = Auth::user()->profil;

        $profilLengkap = $profil
            && !empty($profil->nomor_telepon)
            && !empty($profil->alamat);
        if (!$profilLengkap) {
            return redirect()
                ->route('profil-peminjam.index')
                ->with('error', 'Lengkapi profil terlebih dahulu.');
        }
        return view('peminjam.peminjaman.create', compact('buku'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'buku_id' => 'required|exists:buku,id',
            'tanggal_jatuh_tempo' => 'required|date|after:today',
        ]);

        $user = Auth::user();

        // 🔒 Cek apakah user sudah punya peminjaman aktif
        $peminjamanAktif = Peminjaman::where('peminjam_id', $user->id)
            ->whereIn('status', [
                'menunggu_validasi',
                'dipinjam',
                'terlambat'
            ])
            ->whereNull('tanggal_kembali')
            ->exists();

        if ($peminjamanAktif) {
            return back()->with('error', 'Kamu hanya bisa meminjam 1 buku dalam satu waktu.');
        }

        $buku = Buku::findOrFail($validated['buku_id']);

        // 🔒 Cek stok
        if ($buku->jumlah_buku <= 0) {
            return back()->with('error', 'Stok buku habis.');
        }

        // Simpan peminjaman
        Peminjaman::create([
            'buku_id' => $buku->id,
            'peminjam_id' => $user->id,
            'tanggal_pinjam' => Carbon::today(),
            'tanggal_jatuh_tempo' => $validated['tanggal_jatuh_tempo'],
            'jumlah_dipinjam' => 1,
            'status' => 'menunggu_validasi',
        ]);

        // Update status jika habis
        // if ($buku->jumlah_buku == 0) {
        //     $buku->status = 'habis';
        // }

        // $buku->save();

        return redirect()
            ->route('peminjam.riwayat-peminjaman.index')
            ->with('success', 'Pengajuan peminjaman berhasil dikirim.');
    }
}
