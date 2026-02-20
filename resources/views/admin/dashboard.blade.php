<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-[#09637E]">
            Dashboard Admin
        </h2>
    </x-slot>

    <div class="py-8 bg-[#EBF4F6] min-h-screen">
        <div class="max-w-6xl mx-auto px-6 space-y-8">

            {{-- ALERT SECTION --}}
            @if($terlambat > 0)
                <div class="bg-red-50 border border-red-200 text-red-700 p-4 rounded-2xl shadow-sm">
                    ⚠️ Ada <strong>{{ $terlambat }}</strong> buku yang terlambat dikembalikan.
                </div>
            @endif


            {{-- KPI SECTION --}}
            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">

                <div class="bg-white rounded-2xl shadow-sm border border-[#7AB2B2]/40 p-6">
                    <p class="text-sm text-gray-500">Total Buku</p>
                    <h3 class="text-3xl font-bold text-[#09637E] mt-2">
                        {{ $totalBuku }}
                    </h3>
                </div>

                <div class="bg-white rounded-2xl shadow-sm border border-[#7AB2B2]/40 p-6">
                    <p class="text-sm text-gray-500">Total User</p>
                    <h3 class="text-3xl font-bold text-[#09637E] mt-2">
                        {{ $totalUser }}
                    </h3>
                </div>

                <div class="bg-white rounded-2xl shadow-sm border border-[#7AB2B2]/40 p-6">
                    <p class="text-sm text-gray-500">Peminjaman Aktif</p>
                    <h3 class="text-3xl font-bold text-[#088395] mt-2">
                        {{ $peminjamanAktif }}
                    </h3>
                </div>

                <div class="bg-white rounded-2xl shadow-sm border border-[#7AB2B2]/40 p-6">
                    <p class="text-sm text-gray-500">Terlambat</p>
                    <h3 class="text-3xl font-bold text-red-600 mt-2">
                        {{ $terlambat }}
                    </h3>
                </div>

            </div>


            {{-- ACTIVITY SECTION --}}
            <div class="bg-white rounded-3xl shadow-sm border border-[#7AB2B2]/40 p-6">
                <h3 class="text-lg font-semibold text-[#09637E] mb-4">
                    Aktivitas Peminjaman Terbaru
                </h3>

                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="text-sm text-gray-500 border-b border-[#7AB2B2]/30">
                                <th class="pb-2">User</th>
                                <th class="pb-2">Buku</th>
                                <th class="pb-2">Jatuh Tempo</th>
                                <th class="pb-2">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($latestPeminjaman as $item)
                                <tr class="border-b border-gray-100 hover:bg-[#EBF4F6]/40">
                                    <td class="py-3">{{ $item->peminjam->nama }}</td>
                                    <td class="py-3">{{ $item->buku->judul_buku }}</td>
                                    <td class="py-3">
                                        {{ \Carbon\Carbon::parse($item->tanggal_jatuh_tempo)->format('d M Y') }}
                                    </td>
                                    <td class="py-3">
                                        @if($item->tanggal_kembali)
                                            <span class="px-3 py-1 text-xs rounded-full bg-green-100 text-green-700">
                                                Dikembalikan
                                            </span>
                                        @elseif($item->tanggal_jatuh_tempo < now())
                                            <span class="px-3 py-1 text-xs rounded-full bg-red-100 text-red-700">
                                                Terlambat
                                            </span>
                                        @else
                                            <span class="px-3 py-1 text-xs rounded-full bg-blue-100 text-blue-700">
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


            {{-- QUICK ACTION --}}
            <div class="flex flex-wrap gap-4">
                <a href="{{ route('admin.data-buku.index') }}"
                   class="px-6 py-3 bg-[#088395] hover:bg-[#09637E] text-white rounded-2xl shadow-sm transition">
                    Kelola Buku
                </a>

                <a href="{{ route('admin.data-kategori.index') }}"
                   class="px-6 py-3 bg-[#088395] hover:bg-[#09637E] text-white rounded-2xl shadow-sm transition">
                    Kelola Kategori
                </a>

                <a href="{{ route('admin.riwayat-peminjaman') }}"
                   class="px-6 py-3 bg-[#088395] hover:bg-[#09637E] text-white rounded-2xl shadow-sm transition">
                    Monitoring Peminjaman
                </a>
            </div>

        </div>
    </div>
</x-app-layout>
