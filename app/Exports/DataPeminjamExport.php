<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DataPeminjamExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return User::with('profil')
            ->where('role', 'peminjam')
            ->get()
            ->map(function ($user) {
                return [
                    'Nama' => $user->nama,
                    'Username' => $user->username,
                    'Email' => $user->email,
                    'No Telepon' => $user->profil->nomor_telepon ?? '-',
                    'Alamat' => $user->profil->alamat ?? '-',
                    'Jumlah Peminjaman' => $user->peminjaman()->count(),
                    'Terdaftar' => $user->created_at->format('d-m-Y'),
                ];
            });
    }

    public function headings(): array
    {
        return [
            'Nama',
            'Username',
            'Email',
            'No Telepon',
            'Alamat',
            'Jumlah Peminjaman',
            'Tanggal Daftar',
        ];
    }
}
