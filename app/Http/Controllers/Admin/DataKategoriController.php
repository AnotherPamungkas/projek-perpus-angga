<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;

class DataKategoriController extends Controller
{
    // tampilkan data kategori
    public function index()
    {
        $kategori = Kategori::all();
        return view('admin.data-kategori.index', compact('kategori'));
    }

    // form tambah kategori
    public function create()
    {
        return view('admin.data-kategori.create');
    }

    // simpan kategori
    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:100|unique:kategori,nama_kategori'
        ]);

        Kategori::create([
            'nama_kategori' => $request->nama_kategori
        ]);

        return redirect()->route('admin.data-kategori.index')
            ->with('success', 'Kategori berhasil ditambahkan');
    }

    // form edit
    public function edit($id)
    {
        $kategori = Kategori::findOrFail($id);
        return view('admin.data-kategori.edit', compact('kategori'));
    }

    // update kategori
    public function update(Request $request, $id)
    {
        $kategori = Kategori::findOrFail($id);

        $request->validate([
            'nama_kategori' => 'required|string|max:100|unique:kategori,nama_kategori,' . $id
        ]);

        $kategori->update([
            'nama_kategori' => $request->nama_kategori
        ]);

        return redirect()->route('admin.data-kategori.index')
            ->with('success', 'Kategori berhasil diperbarui');
    }

    // hapus kategori
    public function destroy($id)
    {
        $kategori = Kategori::findOrFail($id);
        $kategori->delete();

        return redirect()->route('admin.data-kategori.index')
            ->with('success', 'Kategori berhasil dihapus');
    }
}
