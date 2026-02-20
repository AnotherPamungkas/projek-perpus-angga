<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kategori;

class DataKategoriController extends Controller
{
    public function index()
    {
        $kategori = Kategori::withCount('buku')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('petugas.data-kategori.index', compact('kategori'));
    }

    public function create()
    {
        return view('petugas.data-kategori.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255|unique:kategori,nama_kategori',
        ]);

        Kategori::create([
            'nama_kategori' => $request->nama_kategori,
        ]);

        return redirect()
            ->route('petugas.data-kategori.index')
            ->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $kategori = Kategori::findOrFail($id);

        return view('petugas.data-kategori.edit', compact('kategori'));
    }

    public function update(Request $request, $id)
    {
        $kategori = Kategori::findOrFail($id);

        $request->validate([
            'nama_kategori' => 'required|string|max:255|unique:kategori,nama_kategori,' . $id,
        ]);

        $kategori->update([
            'nama_kategori' => $request->nama_kategori,
        ]);

        return redirect()
            ->route('petugas.data-kategori.index')
            ->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $kategori = Kategori::withCount('buku')->findOrFail($id);

        if ($kategori->buku_count > 0) {
            return redirect()
                ->route('petugas.data-kategori.index')
                ->with('success', 'Kategori tidak dapat dihapus karena masih digunakan.');
        }

        $kategori->delete();

        return redirect()
            ->route('petugas.data-kategori.index')
            ->with('success', 'Kategori berhasil dihapus.');
    }
}
