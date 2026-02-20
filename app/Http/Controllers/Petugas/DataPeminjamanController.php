<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use Illuminate\Http\Request;
use App\Models\Peminjaman;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class DataPeminjamanController extends Controller
{
    public function index(Request $request)
    {
        // Auto update status terlambat
        Peminjaman::where('status', 'dipinjam')
            ->whereNull('tanggal_kembali')
            ->whereDate('tanggal_jatuh_tempo', '<', now())
            ->update([
                'status' => 'terlambat'
            ]);

        $query = Peminjaman::with(['buku', 'peminjam'])
            ->whereNotIn('status', ['dikembalikan', 'ditolak', 'menunggu_validasi']);

        // 🔎 Search
        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->whereHas('buku', function ($b) use ($request) {
                    $b->where('judul_buku', 'like', '%' . $request->search . '%');
                })
                    ->orWhereHas('peminjam', function ($u) use ($request) {
                        $u->where('nama', 'like', '%' . $request->search . '%')
                            ->orWhere('username', 'like', '%' . $request->search . '%');
                    });
            });
        }

        // 📌 Filter status
        if ($request->status) {
            $query->where('status', $request->status);
        }

        $peminjaman = $query->latest()->paginate(10);

        // 📊 Summary
        $totalDipinjam = Peminjaman::where('status', 'dipinjam')->count();
        $totalTerlambat = Peminjaman::where('status', 'terlambat')->count();

        return view('petugas.data-peminjaman.index', compact(
            'peminjaman',
            'totalDipinjam',
            'totalTerlambat'
        ));
    }

    public function konfirmasi(Peminjaman $peminjaman)
    {
        if ($peminjaman->status === 'dikembalikan') {
            return back()->with('error', 'Peminjaman sudah dikembalikan.');
        }

        if ($peminjaman->status === 'terlambat' && !$peminjaman->denda) {
            return back()->with('error', 'Harap berikan sanksi terlebih dahulu.');
        }

        DB::transaction(function () use ($peminjaman) {

            $peminjaman->update([
                'status' => 'dikembalikan',
                'tanggal_kembali' => now(),
                'status_pembayaran' => 'sudah_bayar'
            ]);

            Buku::where('id', $peminjaman->buku_id)
                ->increment('jumlah_buku', $peminjaman->jumlah_dipinjam);
        });

        return back()->with('success', 'Pengembalian berhasil dikonfirmasi.');
    }

    public function berikanSanksi(Request $request, Peminjaman $peminjaman)
    {
        if ($peminjaman->status !== 'terlambat') {
            return back()->with('error', 'Sanksi hanya untuk status terlambat.');
        }

        if ($peminjaman->denda > 0) {
            return back()->with('error', 'Sanksi sudah diberikan.');
        }

        $request->validate([
            'denda' => 'required|numeric|min:1000'
        ]);

        $peminjaman->update([
            'denda' => $request->denda,
            'status_pembayaran' => 'belum_bayar'
        ]);

        return back()->with('success', 'Denda berhasil ditetapkan.');
    }
}
