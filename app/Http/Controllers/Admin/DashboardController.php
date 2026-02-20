<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use App\Models\User;
use App\Models\Peminjaman;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBuku = Buku::count();
        $totalUser = User::count();

        $totalPeminjaman = Peminjaman::count();

        $peminjamanAktif = Peminjaman::whereNull('tanggal_kembali')->count();

        $terlambat = Peminjaman::whereNull('tanggal_kembali')
            ->where('tanggal_jatuh_tempo', '<', Carbon::now())
            ->count();

        $dikembalikan = Peminjaman::whereNotNull('tanggal_kembali')->count();

        $bukuDipinjam = Buku::where('status', 'dipinjam')->count();
        $bukuTersedia = Buku::where('status', 'tersedia')->count();

        $latestPeminjaman = Peminjaman::with(['peminjam', 'buku'])
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalBuku',
            'totalUser',
            'totalPeminjaman',
            'peminjamanAktif',
            'terlambat',
            'dikembalikan',
            'bukuDipinjam',
            'bukuTersedia',
            'latestPeminjaman'
        ));
    }
}
