<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-[#1557b0]">
            Dashboard Admin
        </h2>
    </x-slot>

    <div class="py-8 min-h-screen
        bg-gradient-to-br from-[#eaf2ff] via-white to-[#d6e6ff]">

        <div class="max-w-6xl mx-auto px-6 space-y-8">

            {{-- ALERT --}}
            @if($terlambat > 0)
                <div class="bg-red-50 border border-red-200 text-red-700 p-4 rounded-2xl shadow-sm">
                    ⚠️ Ada <strong>{{ $terlambat }}</strong> buku yang terlambat dikembalikan.
                </div>
            @endif

            {{-- KPI --}}
            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">

                <div class="bg-white rounded-2xl shadow-sm border border-blue-100 p-6">
                    <p class="text-sm text-gray-500">Total Buku</p>
                    <h3 class="text-3xl font-bold text-[#1557b0] mt-2">
                        {{ $totalBuku }}
                    </h3>
                </div>

                <div class="bg-white rounded-2xl shadow-sm border border-blue-100 p-6">
                    <p class="text-sm text-gray-500">Total User</p>
                    <h3 class="text-3xl font-bold text-[#1557b0] mt-2">
                        {{ $totalUser }}
                    </h3>
                </div>

                <div class="bg-white rounded-2xl shadow-sm border border-blue-100 p-6">
                    <p class="text-sm text-gray-500">Peminjaman Aktif</p>
                    <h3 class="text-3xl font-bold text-[#1a73e8] mt-2">
                        {{ $peminjamanAktif }}
                    </h3>
                </div>

                <div class="bg-white rounded-2xl shadow-sm border border-blue-100 p-6">
                    <p class="text-sm text-gray-500">Terlambat</p>
                    <h3 class="text-3xl font-bold text-red-500 mt-2">
                        {{ $terlambat }}
                    </h3>
                </div>

            </div>

            {{-- TABLE --}}
            <div class="bg-white rounded-3xl shadow-sm border border-blue-100 p-6">
                <h3 class="text-lg font-semibold text-[#1557b0] mb-4">
                    Aktivitas Peminjaman Terbaru
                </h3>

                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm">
                        <thead>
                            <tr class="text-gray-500 border-b border-blue-100">
                                <th class="pb-2">User</th>
                                <th class="pb-2">Buku</th>
                                <th class="pb-2">Jatuh Tempo</th>
                                <th class="pb-2">Status</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($latestPeminjaman as $item)
                                <tr class="border-b border-gray-100 hover:bg-blue-50 transition">
                                    <td class="py-3">{{ $item->peminjam->nama }}</td>
                                    <td class="py-3">{{ $item->buku->judul_buku }}</td>
                                    <td class="py-3">
                                        {{ \Carbon\Carbon::parse($item->tanggal_jatuh_tempo)->format('d M Y') }}
                                    </td>
                                    <td class="py-3">

                                        @if($item->tanggal_kembali)
                                            <span class="px-3 py-1 text-xs rounded-full bg-green-100 text-green-600">
                                                Dikembalikan
                                            </span>

                                        @elseif($item->tanggal_jatuh_tempo < now())
                                            <span class="px-3 py-1 text-xs rounded-full bg-red-100 text-red-600">
                                                Terlambat
                                            </span>

                                        @else
                                            <span class="px-3 py-1 text-xs rounded-full bg-blue-100 text-blue-600">
                                                Dipinjam
                                            </span>
                                        @endif

                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="py-4 text-center text-gray-400">
                                        Belum ada aktivitas.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- ACTION --}}
            <div class="flex flex-wrap gap-4">

                <a href="{{ route('admin.data-buku.index') }}"
                   class="px-6 py-3 text-white rounded-xl shadow-sm transition
                   bg-gradient-to-r from-[#1557b0] to-[#1a73e8]
                   hover:from-[#144a96] hover:to-[#1666cc]">
                    Kelola Buku
                </a>

                <a href="{{ route('admin.data-kategori.index') }}"
                   class="px-6 py-3 text-white rounded-xl shadow-sm transition
                   bg-gradient-to-r from-[#1557b0] to-[#1a73e8]
                   hover:from-[#144a96] hover:to-[#1666cc]">
                    Kelola Kategori
                </a>

                <a href="{{ route('admin.riwayat-peminjaman') }}"
                   class="px-6 py-3 text-white rounded-xl shadow-sm transition
                   bg-gradient-to-r from-[#1557b0] to-[#1a73e8]
                   hover:from-[#144a96] hover:to-[#1666cc]">
                    Monitoring Peminjaman
                </a>

            </div>

        </div>
    </div>
</x-app-layout>
