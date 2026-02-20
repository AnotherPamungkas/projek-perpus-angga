<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DataPetugasExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return User::where('role', 'petugas')
            ->get()
            ->map(function ($user) {
                return [
                    'Nama'          => $user->nama,
                    'Username'      => $user->username,
                    'Email'         => $user->email,
                    'Tanggal Daftar'=> $user->created_at
                        ? $user->created_at->format('d-m-Y')
                        : '-',
                ];
            });
    }

    public function headings(): array
    {
        return [
            'Nama',
            'Username',
            'Email',
            'Tanggal Daftar',
        ];
    }
}
