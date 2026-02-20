<?php

namespace App\Exports;

use App\Models\Ulasan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class UlasanExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Ulasan::with(['buku','peminjam'])
            ->latest()
            ->get();
    }

    public function headings(): array
    {
        return [
            'Judul Buku',
            'Nama Peminjam',
            'Username',
            'Rating',
            'Isi Ulasan',
            'Tanggal Dibuat'
        ];
    }

    public function map($ulasan): array
    {
        return [
            $ulasan->buku->judul_buku ?? '-',
            $ulasan->peminjam->nama ?? '-',
            $ulasan->peminjam->username ?? '-',
            $ulasan->rating,
            $ulasan->isi_ulasan,
            $ulasan->created_at->format('d-m-Y H:i')
        ];
    }
}
