<x-app-layout>
    <div class="p-6">
        <h1 class="text-2xl font-bold mb-4">Verifikasi Buku</h1>

        @if($dataBuku->isEmpty())
            <p class="text-gray-500">Tidak ada buku yang menunggu verifikasi.</p>
        @else
            <table class="w-full border">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="border px-4 py-2">Judul</th>
                        <th class="border px-4 py-2">Pengarang</th>
                        <th class="border px-4 py-2">Tahun</th>
                        <th class="border px-4 py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dataBuku as $buku)
                        <tr>
                            <td class="border px-4 py-2">{{ $buku->judul_buku }}</td>
                            <td class="border px-4 py-2">{{ $buku->pengarang }}</td>
                            <td class="border px-4 py-2">{{ $buku->tahun_terbit }}</td>
                            <td class="border px-4 py-2">
                                <a href="{{ route('admin.verifikasi-buku.detail', $buku->id) }}"
                                   class="text-blue-600 hover:underline">
                                    Detail
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</x-app-layout>
