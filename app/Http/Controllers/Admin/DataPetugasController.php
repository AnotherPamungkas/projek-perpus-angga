<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Exports\DataPetugasExport;
use Maatwebsite\Excel\Facades\Excel;


class DataPetugasController extends Controller
{
    // tampilkan data petugas
    public function index(Request $request)
{
    $query = User::where('role', 'petugas')
        ->select('id', 'nama', 'username', 'email', 'created_at');

    if ($request->search) {
        $query->where(function ($q) use ($request) {
            $q->where('nama', 'like', '%' . $request->search . '%')
              ->orWhere('username', 'like', '%' . $request->search . '%')
              ->orWhere('email', 'like', '%' . $request->search . '%');
        });
    }

    $petugas = $query->latest()->paginate(10)->withQueryString();

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
            'username' => 'required|string|max:100|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6'
        ]);

        User::create([
            'nama' => $request->nama,
            'username' => $request->username,
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
            'nama' => 'nullable|string|max:100',
            'username' => 'nullable|string|max:100|unique:users,username,' . $id,
            'email' => 'nullable|email|unique:users,email,' . $id,
            'password' => 'nullable|min:6'
        ]);

        $petugas->update([
            'nama' => $request->nama,
            'username' => $request->username,
            'email' => $request->email,
            'password' => $request->password
                ? Hash::make($request->password)
                : $petugas->password,
        ]);

        return redirect()->route('admin.data-petugas.index')
            ->with('success', 'Data petugas berhasil diperbarui');
    }

    public function export()
    {
        return Excel::download(new DataPetugasExport, 'data-petugas.xlsx');
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
