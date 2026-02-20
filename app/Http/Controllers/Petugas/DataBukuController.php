<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\Kategori;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DataBukuExport;

class DataBukuController extends Controller
{
    public function index(Request $request)
    {
        $query = Buku::withCount(['creator', 'kategori', 'peminjaman as sedang_dipinjam' => function ($q) {
            $q->where('status', '!=', 'dikembalikan');
        }])
        ->latest();

        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('judul_buku', 'like', '%' . $request->search . '%')
                    ->orWhere('pengarang', 'like', '%' . $request->search . '%')
                    ->orWhereHas('kategori', function ($k) use ($request) {
                        $k->where('nama_kategori', 'like', '%' . $request->search . '%');
                    });
            });
        }

        $buku = $query->paginate(10);

        return view('petugas.data-buku.index', compact('buku'));
    }

    public function create()
    {
        $kategori = Kategori::orderBy('nama_kategori')->get();

        return view('petugas.data-buku.create', compact('kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul_buku'   => 'required|string|max:255',
            'pengarang'    => 'required|string|max:255',
            'penerbit'     => 'required|string|max:255',
            'tahun_terbit' => 'required|digits:4',
            'kategori_id'  => 'required|exists:kategori,id',
            'jumlah_buku'  => 'required|integer|min:1',
            'cover'        => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $coverPath = null;

        if ($request->hasFile('cover')) {
            $coverPath = $request->file('cover')->store('covers', 'public');
        }

        Buku::create([
            'judul_buku'   => $request->judul_buku,
            'pengarang'    => $request->pengarang,
            'penerbit'     => $request->penerbit,
            'tahun_terbit' => $request->tahun_terbit,
            'kategori_id'  => $request->kategori_id,
            'jumlah_buku'  => $request->jumlah_buku,
            'deskripsi'    => $request->deskripsi,
            'cover'        => $coverPath,
            'status'       => $request->jumlah_buku > 0 ? 'tersedia' : 'tidak tersedia',
            'created_by'   => Auth::id(),
        ]);

        return redirect()
            ->route('petugas.data-buku.index')
            ->with('success', 'Buku berhasil ditambahkan.');
    }

    public function edit(Buku $buku)
    {
        $kategori = Kategori::orderBy('nama_kategori')->get();

        return view('petugas.data-buku.edit', compact('buku', 'kategori'));
    }

    public function update(Request $request, Buku $buku)
    {
        $request->validate([
            'judul_buku'   => 'required|string|max:255',
            'pengarang'    => 'required|string|max:255',
            'penerbit'     => 'required|string|max:255',
            'tahun_terbit' => 'required|digits:4',
            'kategori_id'  => 'required|exists:kategori,id',
            'jumlah_buku'  => 'required|integer|min:0',
            'cover'        => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('cover')) {
            if ($buku->cover) {
                Storage::disk('public')->delete($buku->cover);
            }

            $buku->cover = $request->file('cover')->store('covers', 'public');
        }

        $buku->update([
            'judul_buku'   => $request->judul_buku,
            'pengarang'    => $request->pengarang,
            'penerbit'     => $request->penerbit,
            'tahun_terbit' => $request->tahun_terbit,
            'kategori_id'  => $request->kategori_id,
            'jumlah_buku'  => $request->jumlah_buku,
            'deskripsi'    => $request->deskripsi,
            'status'       => $request->jumlah_buku > 0 ? 'tersedia' : 'tidak tersedia',
        ]);

        return redirect()
            ->route('petugas.data-buku.index')
            ->with('success', 'Buku berhasil diperbarui.');
    }

    public function destroy(Buku $buku)
    {
        $sedangDipinjam = $buku->peminjaman()
            ->where('status', '!=', 'dikembalikan')
            ->exists();

        if ($sedangDipinjam) {
            return redirect()
                ->back()
                ->with('error', 'Buku tidak dapat dihapus karena sedang dipinjam.');
        }

        if ($buku->cover) {
            Storage::disk('public')->delete($buku->cover);
        }

        $buku->delete();

        return redirect()
            ->route(Auth::user()->role . '.data-buku.index')
            ->with('success', 'Buku berhasil dihapus.');
    }


      public function export()
    {
        return Excel::download(new DataBukuExport, 'data-buku.xlsx');
    }
}
