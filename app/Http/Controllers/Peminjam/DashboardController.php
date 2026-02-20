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

        // Peminjaman yang punya denda dan belum dibayar
        $dendaBelumBayar = $user->peminjaman()
            ->where('denda', '>', 0)
            ->where('status_pembayaran', 'belum_bayar')
            ->with('buku')
            ->get();

        // Total nominal denda
        $totalDenda = $dendaBelumBayar->sum('denda');

        // Jumlah buku terlambat (belum dikembalikan & lewat jatuh tempo)
        $terlambat = $user->peminjaman()
            ->whereNull('tanggal_kembali')
            ->whereDate('tanggal_jatuh_tempo', '<', now())
            ->count();

        // Buku aktif
        $bukuAktif = $user->peminjaman()
            ->whereNull('tanggal_kembali')
            ->count();

        // Hampir jatuh tempo (<= 2 hari)
        $hampirJatuhTempo = $user->peminjaman()
            ->whereNull('tanggal_kembali')
            ->whereDate('tanggal_jatuh_tempo', '<=', Carbon::now()->addDays(2))
            ->count();

        // Data detail jatuh tempo
        $peringatanJatuhTempo = $user->peminjaman()
            ->whereNull('tanggal_kembali')
            ->whereDate('tanggal_jatuh_tempo', '<=', Carbon::now()->addDays(2))
            ->with('buku')
            ->get();

        // Total riwayat
        $totalRiwayat = $user->peminjaman()->count();

        // Total denda
        //$totalDenda = $user->peminjaman()->sum('denda');

        // Buku favorit
        $bukuFavorit = $user->favoritBuku()
            ->latest()
            ->take(8)
            ->get();

        // Buku sedang dipinjam
        $bukuDipinjam = $user->peminjaman()
            ->whereNull('tanggal_kembali')
            ->with('buku')
            ->get();

        // Kuota (misalnya maksimal 3 buku)
        $maksimalPinjam = 3;
        $persentaseKuota = ($bukuAktif / $maksimalPinjam) * 100;

        // Buku terbaru (6 terbaru)
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
