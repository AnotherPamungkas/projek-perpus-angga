<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\RiwayatPeminjamanExport;

class RiwayatPeminjamanController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');

        $riwayat = Peminjaman::with(['buku','peminjam'])
            ->whereIn('status', ['dikembalikan','ditolak'])
            ->when($search, function ($query) use ($search) {
                $query->whereHas('buku', function ($q) use ($search) {
                    $q->where('judul_buku', 'like', "%{$search}%");
                })->orWhereHas('peminjam', function ($q) use ($search) {
                    $q->where('nama', 'like', "%{$search}%")
                      ->orWhere('username', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('petugas.riwayat-peminjaman.index', compact('riwayat','search'));
    }

    public function export(Request $request)
    {
        return Excel::download(
            new RiwayatPeminjamanExport($request->search),
            'riwayat-peminjaman.xlsx'
        );
    }
}
