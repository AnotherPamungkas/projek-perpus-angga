<?php

namespace App\Http\Controllers\Peminjam;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfilController extends Controller
{
    public function index()
    {
        $user = Auth::user()->load('profil');

        return view('peminjam.profil.index', compact('user'));
    }

    public function edit()
    {
        $user = Auth::user()->load('profil');

        return view('peminjam.profil.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'nama' => 'required|string|max:100',
            'username' => 'required|string|max:50|unique:users,username,' . $user->id,
            'email' => 'required|email|unique:users,email,' . $user->id,
            'nomor_telepon' => 'nullable|string|max:20',
            'alamat' => 'nullable|string|max:255',
        ]);

        // Update tabel users
        $user->update([
            'nama' => $validated['nama'],
            'username' => $validated['username'],
            'email' => $validated['email'],
        ]);

        // Update atau create profil
        $user->profil()->updateOrCreate(
            ['peminjam_id' => $user->id],
            [
                'nomor_telepon' => $validated['nomor_telepon'],
                'alamat' => $validated['alamat'],
            ]
        );

        return redirect()
            ->route('profil-peminjam.index')
            ->with('success', 'Profil berhasil diperbarui.');
    }
}
