<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use Illuminate\Http\Request;

class VerifikasiBukuController extends Controller
{
    public function index() {
        $dataBuku = Buku::where('status', 'menunggu_validasi')->get();
        return view('admin.verifikasi-buku.index', compact('dataBuku'));
    }

    public function detail(Buku $buku) {
        return view('admin.verifikasi-buku.detail', compact('buku'));
    }

    public function verify(Buku $buku) {
        $buku->update([
            'status' => 'disetujui'
        ]);

        return redirect()->route('admin.verifikasi-buku.index');
    }

    public function reject(Buku $buku) {
        $buku->update([
            'status' => 'ditolak'
        ]);

        return redirect()->route('admin.verifikasi-buku.index');
    }
}
