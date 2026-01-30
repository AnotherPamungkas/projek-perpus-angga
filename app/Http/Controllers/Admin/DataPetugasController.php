<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DataPetugasController extends Controller
{
    // tampilkan data petugas
    public function index()
    {
        $petugas = User::where('role', 'petugas')->get();
        return view('admin.data-petugas.index', compact('petugas'));
    }

    // form tambah petugas
    public function create()
    {
        return view('admin.data-petugas.create');
    }

    // simpan petugas baru
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6'
        ]);

        User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'petugas'
        ]);

        return redirect()->route('admin.data-petugas.index')
            ->with('success', 'Petugas berhasil ditambahkan');
    }

    // form edit
    public function edit($id)
    {
        $petugas = User::where('role', 'petugas')->findOrFail($id);
        return view('admin.data-petugas.edit', compact('petugas'));
    }

    // update data
    public function update(Request $request, $id)
    {
        $petugas = User::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|min:6'
        ]);

        $petugas->update([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => $request->password
                ? Hash::make($request->password)
                : $petugas->password,
        ]);

        return redirect()->route('admin.data-petugas.index')
            ->with('success', 'Data petugas berhasil diperbarui');
    }

    // hapus petugas
    public function destroy($id)
    {
        $petugas = User::where('role', 'petugas')->findOrFail($id);
        $petugas->delete();

        return redirect()->route('admin.data-petugas.index')
            ->with('success', 'Petugas berhasil dihapus');
    }
}
