<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Peminjaman;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class ValidasiPeminjamanController extends Controller
{
    public function index()
    {
        $peminjaman = Peminjaman::with(['buku.kategori', 'peminjam'])
            ->where('status', 'menunggu_validasi')
            ->latest()
            ->paginate(9);

        $totalMenunggu = Peminjaman::where('status', 'menunggu_validasi')->count();

        return view('petugas.validasi-peminjaman.index', compact(
            'peminjaman',
            'totalMenunggu'
        ));
    }

    public function detail(Peminjaman $peminjaman)
    {
        if ($peminjaman->status !== 'menunggu_validasi') {
            return redirect()
                ->route('petugas.validasi-peminjaman.index')
                ->with('error', 'Data tidak tersedia untuk divalidasi.');
        }

        $peminjaman->load(['buku.kategori', 'peminjam.profil']);

        // Hitung riwayat terlambat
        $riwayatTerlambat = $peminjaman->peminjam
            ->peminjaman()
            ->where('status', 'terlambat')
            ->count();

        return view('petugas.validasi-peminjaman.detail', compact(
            'peminjaman',
            'riwayatTerlambat'
        ));
    }

    public function verify(Peminjaman $peminjaman)
    {
        if ($peminjaman->status !== 'menunggu_validasi') {
            return back()->with('error', 'Peminjaman sudah diproses.');
        }

        $buku = $peminjaman->buku;

        if ($buku->jumlah_buku < $peminjaman->jumlah_dipinjam) {
            return back()->with('error', 'Stok buku tidak mencukupi.');
        }


        $peminjaman->update([
            'status' => 'dipinjam',
            'validated_by' => Auth::id(),
            'validated_at' => now(),
        ]);
        
        // Kurangi stok
        $buku->decrement('jumlah_buku', $peminjaman->jumlah_dipinjam);

        return redirect()
            ->route('petugas.validasi-peminjaman.index')
            ->with('success', 'Peminjaman berhasil disetujui.');
    }

    public function reject(Request $request, Peminjaman $peminjaman)
    {
        if ($peminjaman->status !== 'menunggu_validasi') {
            return back()->with('error', 'Peminjaman sudah diproses.');
        }

        $request->validate([
            'alasan_penolakan' => 'required|string|max:500'
        ]);

        $peminjaman->update([
            'status' => 'ditolak',
            'validated_by' => Auth::id(),
            'validated_at' => now(),
            'alasan_penolakan' => $request->alasan_penolakan,
        ]);

        return redirect()
            ->route('petugas.validasi-peminjaman.index')
            ->with('success', 'Peminjaman berhasil ditolak.');
    }
}
