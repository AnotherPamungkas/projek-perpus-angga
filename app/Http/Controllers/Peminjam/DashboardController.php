<?php

namespace App\Http\Controllers\Peminjam;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Buku;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Buku aktif
        $bukuDipinjam = $user->peminjaman()
            ->whereNull('tanggal_kembali')
            ->with('buku')
            ->get();

        // Sinkronisasi keterlambatan
        foreach ($bukuDipinjam as $pinjam) {
            $pinjam->syncKeterlambatan();
        }

        // Refresh data
        $bukuDipinjam = $user->peminjaman()
            ->whereNull('tanggal_kembali')
            ->with('buku')
            ->get();

        // Denda aktif
        $dendaBelumBayar = $user->peminjaman()
            ->where('status', 'terlambat')
            ->where('denda', '>', 0)
            ->where('status_pembayaran', 'belum_bayar')
            ->with('buku')
            ->get();

        // Total denda
        $totalDenda = $dendaBelumBayar->sum('denda');

        // Total terlambat
        $terlambat = $dendaBelumBayar->count();

        // Buku aktif
        $bukuAktif = $bukuDipinjam->count();

        // Hampir jatuh tempo
        $peringatanJatuhTempo = $user->peminjaman()
            ->whereNull('tanggal_kembali')
            ->whereDate('tanggal_jatuh_tempo', '<=', Carbon::now()->addDays(2))
            ->with('buku')
            ->get();

        $hampirJatuhTempo = $peringatanJatuhTempo->count();

        // Riwayat
        $totalRiwayat = $user->peminjaman()->count();

        // Favorit
        $bukuFavorit = $user->favoritBuku()
            ->latest()
            ->take(8)
            ->get();

        // Kuota
        $maksimalPinjam = 3;
        $persentaseKuota = ($bukuAktif / $maksimalPinjam) * 100;

        // Buku terbaru
        $bukuTerbaru = Buku::latest()
            ->take(6)
            ->get();

        return view('peminjam.dashboard', compact(
            'bukuAktif',
            'hampirJatuhTempo',
            'totalRiwayat',
            'bukuFavorit',
            'bukuDipinjam',
            'maksimalPinjam',
            'persentaseKuota',
            'peringatanJatuhTempo',
            'bukuTerbaru',
            'dendaBelumBayar',
            'totalDenda',
            'terlambat'
        ));
    }
}
