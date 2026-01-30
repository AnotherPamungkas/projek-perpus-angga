<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DataBukuController extends Controller
{
    // index
    public function index()
    {
        $buku = Buku::with('kategori')->get();
        return view('admin.data-buku.index', compact('buku'));
    }

    // create
    public function create()
    {
        $kategori = Kategori::all();
        return view('admin.data-buku.create', compact('kategori'));
    }

    // store
    public function store(Request $request)
{
    $request->validate([
        'judul_buku'   => 'required|string|max:255',
        'pengarang'    => 'required|string|max:255',
        'penerbit'     => 'required|string|max:255',
        'tahun_terbit' => 'required|digits:4',
        'kategori_id'  => 'required|exists:kategori,id',
        'jumlah_buku'  => 'required|integer|min:1',
        'deskripsi'    => 'nullable|string',
        'cover'        => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $coverName = null;

    if ($request->hasFile('cover')) {
        $coverName = time() . '.' . $request->cover->extension();
        $request->cover->storeAs('public/cover-buku', $coverName);
    }

    Buku::create([
        'judul_buku'   => $request->judul_buku,
        'pengarang'    => $request->pengarang,
        'penerbit'     => $request->penerbit,
        'tahun_terbit' => $request->tahun_terbit,
        'kategori_id'  => $request->kategori_id,
        'jumlah_buku'  => $request->jumlah_buku,
        'deskripsi'    => $request->deskripsi,
        'status'       => 'disetujui',
        'cover'        => $coverName,
    ]);

    return redirect()->route('admin.data-buku.index')
        ->with('success', 'Data buku berhasil ditambahkan');
}


    // edit
    public function edit($id)
    {
        $buku = Buku::findOrFail($id);
        $kategori = Kategori::all();

        return view('admin.data-buku.edit', compact('buku', 'kategori'));
    }

    // update

public function update(Request $request, $id)
{
    $buku = Buku::findOrFail($id);

    $validated = $request->validate([
        'judul_buku'   => 'required|string|max:255',
        'pengarang'    => 'required|string|max:255',
        'penerbit'     => 'required|string|max:255',
        'tahun_terbit' => 'required|digits:4',
        'kategori_id'  => 'required|exists:kategori,id',
        'jumlah_buku'  => 'required|integer|min:1',
        'deskripsi'    => 'nullable|string',
        'cover'        => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    // handle cover baru
    if ($request->hasFile('cover')) {

        // hapus cover lama jika ada
        if ($buku->cover && Storage::exists('public/cover-buku/' . $buku->cover)) {
            Storage::delete('public/cover-buku/' . $buku->cover);
        }

        $coverName = time() . '.' . $request->cover->extension();
        $request->cover->storeAs('public/cover-buku', $coverName);

        $validated['cover'] = $coverName;
    }

    $buku->update($validated);

    return redirect()->route('admin.data-buku.index')
        ->with('success', 'Data buku berhasil diperbarui');
}


    // delete
   public function destroy($id)
{
    $buku = Buku::findOrFail($id);

    if ($buku->cover && Storage::exists('public/cover-buku/' . $buku->cover)) {
        Storage::delete('public/cover-buku/' . $buku->cover);
    }

    $buku->delete();

    return redirect()->route('admin.data-buku.index')
        ->with('success', 'Data buku berhasil dihapus');
}

}
