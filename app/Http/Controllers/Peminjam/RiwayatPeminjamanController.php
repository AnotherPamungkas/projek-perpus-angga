<?php

namespace App\Http\Controllers\Peminjam;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use App\Models\Ulasan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class RiwayatPeminjamanController extends Controller
{
    public function index(Request $request)
    {
        $query = Peminjaman::with('buku')
            ->where('peminjam_id', Auth::id());

        // 🔎 Search judul buku
        if ($request->search) {
            $query->whereHas('buku', function ($q) use ($request) {
                $q->where('judul_buku', 'like', '%' . $request->search . '%');
            });
        }

        // 🎯 Filter status
        if ($request->status) {
            $query->where('status', $request->status);
        }

        // 📅 Filter tahun
        if ($request->tahun) {
            $query->whereYear('tanggal_pinjam', $request->tahun);
        }

        // 🔄 Sorting
        if ($request->sort == 'lama') {
            $query->orderBy('tanggal_pinjam', 'asc');
        } else {
            $query->orderBy('tanggal_pinjam', 'desc');
        }

        $riwayat = $query->paginate(8)->withQueryString();

        // 📊 Statistik ringkas
        $total = Peminjaman::where('peminjam_id', Auth::id())->count();
        $aktif = Peminjaman::where('peminjam_id', Auth::id())
            ->whereNull('tanggal_kembali')
            ->count();
        $selesai = Peminjaman::where('peminjam_id', Auth::id())
            ->whereNotNull('tanggal_kembali')
            ->count();
        $terlambat = Peminjaman::where('peminjam_id', Auth::id())
            ->whereNull('tanggal_kembali')
            ->where('tanggal_jatuh_tempo', '<', now())
            ->count();

        return view('peminjam.riwayat.index', compact(
            'riwayat',
            'total',
            'aktif',
            'selesai',
            'terlambat'
        ));
    }

    public function detail(Peminjaman $peminjaman)
    {
        if ($peminjaman->peminjam_id !== Auth::id()) {
            abort(403);
        }

        $peminjaman->load('buku.kategori');

        $ulasan = Ulasan::where('buku_id', $peminjaman->buku_id)
            ->where('peminjam_id', Auth::id())
            ->first();

        return view('peminjam.riwayat.detail', compact('peminjaman', 'ulasan'));
    }
}
