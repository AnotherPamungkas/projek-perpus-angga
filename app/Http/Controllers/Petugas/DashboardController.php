<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use App\Models\Peminjaman;
use App\Models\Ulasan;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // 1️⃣ Auto update keterlambatan
        $peminjamanAktif = Peminjaman::where('status', 'dipinjam')
            ->whereNull('tanggal_kembali')
            ->get();

        // Peminjaman::where('status', 'dipinjam')
        //     ->whereNull('tanggal_kembali')
        //     ->whereDate('tanggal_jatuh_tempo', '<', Carbon::now())
        //     ->update([
        //         'status' => 'terlambat',
        //         'denda' => 5000,
        //     ]);

        $today = Carbon::today();

        // Pengembalian hari ini
        $pengembalianHariIni = Peminjaman::whereDate('tanggal_kembali', $today)->count();

        // Buku ditambahkan hari ini
        $bukuHariIni = Buku::whereDate('created_at', $today)->count();

        // Ulasan masuk hari ini
        $ulasanHariIni = Ulasan::whereDate('created_at', $today)->count();

        // 2️⃣ Hitung statistik setelah update
        $totalPeminjamanAktif = Peminjaman::where('status', 'dipinjam')->count();
        $menungguValidasi = Peminjaman::where('status', 'menunggu_validasi')->count();
        $terlambat = Peminjaman::where('status', 'terlambat')->count();
        $totalBuku = Buku::count();

        return view('petugas.dashboard', [
            'peminjamanAktif' => $totalPeminjamanAktif,
            'menungguValidasi' => $menungguValidasi,
            'terlambat' => $terlambat,
            'totalBuku' => $totalBuku,
            'pengembalianHariIni' => $pengembalianHariIni,
            'bukuHariIni' => $bukuHariIni,
            'ulasanHariIni' => $ulasanHariIni
        ]);
    }
}
