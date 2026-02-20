<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Exports\DataPeminjamExport;
use Maatwebsite\Excel\Facades\Excel;

class DataPeminjamController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query()
            ->with(['profil'])
            ->withSum(['peminjaman as total_buku' => function ($q) {
                $q->where('status', 'dikembalikan');
            }], 'jumlah_dipinjam')
            ->where('role', 'peminjam')
            ->select('id', 'nama', 'username', 'email', 'created_at');

        if ($request->search) {
            $query->where('nama', 'like', '%' . $request->search . '%');
        }

        $dataPeminjam = $query->latest()->paginate(10)->withQueryString();

        return view('admin.data-peminjam.index', compact('dataPeminjam'));
    }

    public function destroy(User $peminjam)
    {
        if ($peminjam->role !== 'peminjam') {
            abort(403);
        }

        DB::transaction(function () use ($peminjam) {
            $peminjam->profil()->delete();
            $peminjam->delete();
        });

        return redirect()
            ->route('admin.data-peminjam.index')
            ->with('success', 'Data peminjam berhasil dihapus.');
    }

    public function export()
    {
        return Excel::download(new DataPeminjamExport, 'data-peminjam.xlsx');
    }
}
