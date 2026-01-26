<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Data dummy untuk dashboard perpustakaan
        $stats = [
            'total_buku' => 1250,
            'total_anggota' => 340,
            'peminjaman_hari_ini' => 12
        ];

        // PERUBAHAN DI SINI: 'web.home' diganti menjadi 'admin.home'
        return view('admin.home', compact('stats'));
    }
}