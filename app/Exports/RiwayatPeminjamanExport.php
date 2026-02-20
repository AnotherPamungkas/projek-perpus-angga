<?php

namespace App\Exports;

use App\Models\Peminjaman;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class RiwayatPeminjamanExport implements FromCollection, WithHeadings, WithMapping
{
    protected $search;

    public function __construct($search)
    {
        $this->search = $search;
    }

    public function collection()
    {
        return Peminjaman::with(['buku','peminjam'])
            ->whereIn('status', ['dikembalikan','ditolak'])
            ->when($this->search, function ($query) {
                $query->whereHas('buku', function ($q) {
                    $q->where('judul_buku', 'like', "%{$this->search}%");
                })->orWhereHas('peminjam', function ($q) {
                    $q->where('nama', 'like', "%{$this->search}%")
                      ->orWhere('username', 'like', "%{$this->search}%");
                });
            })
            ->latest()
            ->get();
    }

    public function headings(): array
    {
        return [
            'Judul Buku',
            'Nama Peminjam',
            'Username',
            'Tanggal Pinjam',
            'Tanggal Jatuh Tempo',
            'Tanggal Kembali',
            'Status'
        ];
    }

    public function map($item): array
    {
        return [
            $item->buku->judul_buku ?? '-',
            $item->peminjam->nama ?? '-',
            $item->peminjam->username ?? '-',
            $item->tanggal_pinjam,
            $item->tanggal_jatuh_tempo,
            $item->tanggal_kembali ?? '-',
            ucfirst($item->status)
        ];
    }
}
