<?php

namespace App\Exports;

use App\Models\Buku;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DataBukuExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Buku::with(['kategori', 'creator'])
            ->get()
            ->map(function ($item) {
                return [
                    'Judul Buku'      => $item->judul_buku,
                    'Pengarang'       => $item->pengarang,
                    'Penerbit'        => $item->penerbit,
                    'Tahun Terbit'    => $item->tahun_terbit,
                    'Kategori'        => $item->kategori->nama_kategori ?? '-',
                    'Jumlah Buku'     => $item->jumlah_buku,
                    'Status'          => ucfirst($item->status),
                    'Ditambahkan Oleh'=> $item->creator->nama ?? '-',
                ];
            });
    }

    public function headings(): array
    {
        return [
            'Judul Buku',
            'Pengarang',
            'Penerbit',
            'Tahun Terbit',
            'Kategori',
            'Jumlah Buku',
            'Status',
            'Ditambahkan Oleh',
        ];
    }
}
