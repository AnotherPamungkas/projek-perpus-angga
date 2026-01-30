<x-app-layout>
    <div class="p-6">
        <h1 class="text-2xl font-bold mb-4">Riwayat Peminjaman</h1>

        {{-- Filter --}}
        <form method="GET" class="mb-4">
            <label class="mr-2 font-semibold">Filter Status:</label>
            <select name="status" onchange="this.form.submit()" class="border rounded px-3 py-2">
                <option value="menunggu_validasi" {{ $status == 'menunggu_validasi' ? 'selected' : '' }}>
                    Menunggu Validasi
                </option>
                <option value="disetujui" {{ $status == 'disetujui' ? 'selected' : '' }}>
                    Disetujui
                </option>
                <option value="ditolak" {{ $status == 'ditolak' ? 'selected' : '' }}>
                    Ditolak
                </option>
            </select>
        </form>

        {{-- Table --}}
        <table class="w-full border">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border px-4 py-2">Peminjam</th>
                    <th class="border px-4 py-2">Judul Buku</th>
                    <th class="border px-4 py-2">Tanggal Pinjam</th>
                    <th class="border px-4 py-2">Tanggal Kembali</th>
                    <th class="border px-4 py-2">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($dataPeminjaman as $item)
                    <tr>
                        <td class="border px-4 py-2">
                            {{ $item->user->name ?? '-' }}
                        </td>
                        <td class="border px-4 py-2">
                            {{ $item->buku->judul_buku ?? '-' }}
                        </td>
                        <td class="border px-4 py-2">
                            {{ $item->tanggal_pinjam }}
                        </td>
                        <td class="border px-4 py-2">
                            {{ $item->tanggal_kembali ?? '-' }}
                        </td>
                        <td class="border px-4 py-2">
                            @if ($item->status == 'menunggu_validasi')
                                <span class="text-yellow-600 font-semibold">Menunggu</span>
                            @elseif ($item->status == 'disetujui')
                                <span class="text-green-600 font-semibold">Disetujui</span>
                            @else
                                <span class="text-red-600 font-semibold">Ditolak</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-4 text-gray-500">
                            Data peminjaman tidak ditemukan
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-app-layout>
