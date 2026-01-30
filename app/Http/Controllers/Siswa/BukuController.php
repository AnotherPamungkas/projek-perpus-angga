<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    public function index() {
        $dataBuku = Buku::with('kategori')
        ->where('status', 'disetujui')
        ->get();

        return view('siswa.buku.index', compact('dataBuku'));
    }

    public function detail(Buku $buku) {
        return view('siswa.buku.detail', compact('buku'));
    }
}
