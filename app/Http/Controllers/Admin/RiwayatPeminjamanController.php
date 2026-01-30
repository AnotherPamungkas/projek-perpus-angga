<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class RiwayatPeminjamanController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->query('status', 'menunggu_validasi');

        $dataPeminjaman = Peminjaman::with(['buku', 'siswa'])
            ->when($status, function ($query) use ($status) {
                $query->where('status', $status);
            })
            ->get();

        return view('admin.riwayat-peminjaman.index', compact('dataPeminjaman', 'status'));
    }
}
