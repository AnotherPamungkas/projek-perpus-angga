<?php

namespace App\Http\Controllers\Peminjam;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BukuController extends Controller
{
    public function index(Request $request)
    {
        $query = Buku::with('kategori');

        // Search
        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('judul_buku', 'like', '%' . $request->search . '%')
                    ->orWhere('pengarang', 'like', '%' . $request->search . '%');
            });
        }

        // Filter status
        if ($request->status == 'tersedia') {
            $query->where('status', 'tersedia');
        }

        if ($request->status == 'dipinjam') {
            $query->where('status', 'dipinjam');
        }

        // Sorting
        if ($request->sort == 'az') {
            $query->orderBy('judul_buku', 'asc');
        } elseif ($request->sort == 'za') {
            $query->orderBy('judul_buku', 'desc');
        } else {
            $query->latest();
        }

        $dataBuku = $query->paginate(12)->withQueryString();

        $favoritIds = Auth::user()
            ->favoritBuku()
            ->pluck('buku.id')
            ->toArray();


        return view('peminjam.buku.index', compact('dataBuku', 'favoritIds'));
    }

    public function detail(Buku $buku)
    {
        $user = Auth::user();

        $profil = Auth::user()->profil;

        $profilLengkap = $profil
            && !empty($profil->nomor_telepon)
            && !empty($profil->alamat);


        $isFavorit = $user->favoritBuku()
            ->where('buku_id', $buku->id)
            ->exists();

        $isDipinjam = $user->peminjaman()
            ->where('buku_id', $buku->id)
            ->whereNull('tanggal_kembali')
            ->exists();

        $totalFavorit = $buku->favoritUsers()->count();

        $stokTersedia = $buku->jumlah_buku;

        return view('peminjam.buku.detail', compact(
            'buku',
            'isFavorit',
            'isDipinjam',
            'totalFavorit',
            'stokTersedia',
            'profilLengkap'
        ));
    }

    public function toggleFavorit($id)
    {
        Auth::user()->favoritBuku()->toggle($id);
        return back();
    }
}
