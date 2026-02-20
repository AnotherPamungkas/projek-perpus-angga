<?php

namespace App\Http\Controllers\Admin;

use App\Exports\RiwayatPeminjamanExport;
use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class RiwayatPeminjamanController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $riwayat = Peminjaman::with(['buku', 'peminjam'])
            ->where('status', ['dikembalikan', 'ditolak'])
            ->when($search, function ($query) use ($search) {
                $query->whereHas('buku', function ($q) use ($search) {
                    $q->where('judul_buku', 'like', "%$search%");
                })->orWhereHas('peminjam', function ($q) use ($search) {
                    $q->where('nama', 'like', "%$search%");
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.riwayat-peminjaman.index', compact('riwayat', 'search'));
    }

    public function export(Request $request)
    {
        return Excel::download(
            new RiwayatPeminjamanExport($request->search),
            'riwayat-peminjaman.xlsx'
        );
    }
}
