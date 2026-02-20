<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Ulasan;
use App\Exports\UlasanExport;
use Maatwebsite\Excel\Facades\Excel;

class DataUlasanController extends Controller
{
    public function index()
    {
        $ulasan = Ulasan::with(['buku','peminjam'])
            ->latest()
            ->paginate(10);

        return view('petugas.data-ulasan.index', compact('ulasan'));
    }

    public function export()
    {
        return Excel::download(new UlasanExport, 'data-ulasan.xlsx');
    }
}
