<?php

namespace App\Http\Controllers\Peminjam;

use App\Http\Controllers\Controller;
use App\Models\Ulasan;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UlasanController extends Controller
{
    public function store(Request $request)
    {
        // ✅ Validasi input
        $request->validate([
            'buku_id' => 'required|exists:buku,id',
            'rating' => 'required|integer|min:1|max:5',
            'isi_ulasan' => 'required|string|max:1000',
        ]);

        // ✅ Pastikan buku pernah dipinjam & sudah dikembalikan
        $peminjaman = Peminjaman::where('buku_id', $request->buku_id)
            ->where('peminjam_id', Auth::id())
            ->whereNotNull('tanggal_kembali')
            ->first();

        if (!$peminjaman) {
            return back()->with('error', 'Anda tidak bisa memberi ulasan untuk buku ini.');
        }

        // ✅ Cek apakah sudah pernah review
        $sudahReview = Ulasan::where('buku_id', $request->buku_id)
            ->where('peminjam_id', Auth::id())
            ->exists();

        if ($sudahReview) {
            return back()->with('error', 'Anda sudah memberikan ulasan untuk buku ini.');
        }

        // ✅ Simpan ulasan
        Ulasan::create([
            'buku_id' => $request->buku_id,
            'peminjam_id' => Auth::id(),
            'rating' => $request->rating,
            'isi_ulasan' => $request->isi_ulasan,
        ]);

        return back()->with('success', 'Ulasan berhasil ditambahkan.');
    }
}
