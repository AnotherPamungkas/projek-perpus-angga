<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 space-y-6 bg-[#F4F4F2] min-h-screen">

        {{-- Welcome Section --}}
        <div
            class="bg-[#3D3D3B] rounded-2xl shadow-md p-6 border border-[#BBBFCA] flex flex-col md:flex-row md:items-center md:justify-between gap-4">

            <div>
                <h3 class="text-xl font-bold text-white">
                    Halo, Admin 👋
                </h3>
                <p class="text-sm text-[#E8E8E8] mt-1">
                    Dashboard monitoring perpustakaan dan aktivitas sistem hari ini.
                </p>
            </div>

            <div class="bg-white/10 border border-white/10 rounded-xl px-4 py-3">
                <p class="text-xs text-[#E8E8E8]">
                    Hari Operasional
                </p>
                <p class="text-sm font-bold text-white">
                    {{ now()->format('d M Y') }}
                </p>
            </div>
        </div>

        {{-- Alert --}}
        @if($terlambat > 0)
            <div class="bg-red-50 border border-red-200 rounded-2xl p-5 shadow-sm">
                <p class="text-sm font-semibold text-red-700">
                    ⚠️ Ada {{ $terlambat }} buku yang terlambat dikembalikan.
                </p>
            </div>
        @endif

        {{-- Statistik --}}
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-5">

            {{-- Total Buku --}}
            <div
                class="bg-[#E8E8E8] p-5 rounded-2xl border border-[#BBBFCA] border-t-4 border-t-[#3D3D3B] shadow-sm hover:shadow-md transition-all duration-300 hover:-translate-y-0.5">
                <p class="text-sm text-[#3D3D3B]/70 font-medium">
                    Total Buku
                </p>
                <p class="text-3xl font-bold text-[#3D3D3B] mt-2">
                    {{ $totalBuku }}
                </p>
            </div>

            {{-- Total User --}}
            <div
                class="bg-[#E8E8E8] p-5 rounded-2xl border border-[#BBBFCA] border-t-4 border-t-[#BBBFCA] shadow-sm hover:shadow-md transition-all duration-300 hover:-translate-y-0.5">
                <p class="text-sm text-[#3D3D3B]/70 font-medium">
                    Total User
                </p>
                <p class="text-3xl font-bold text-[#3D3D3B] mt-2">
                    {{ $totalUser }}
                </p>
            </div>

            {{-- Peminjaman Aktif --}}
            <div
                class="bg-[#E8E8E8] p-5 rounded-2xl border border-[#BBBFCA] border-t-4 border-t-yellow-500 shadow-sm hover:shadow-md transition-all duration-300 hover:-translate-y-0.5">
                <p class="text-sm text-[#3D3D3B]/70 font-medium">
                    Peminjaman Aktif
                </p>
                <p class="text-3xl font-bold text-yellow-500 mt-2">
                    {{ $peminjamanAktif }}
                </p>
            </div>

            {{-- Terlambat --}}
            <div
                class="bg-[#E8E8E8] p-5 rounded-2xl border border-[#BBBFCA] border-t-4 border-t-red-500 shadow-sm hover:shadow-md transition-all duration-300 hover:-translate-y-0.5">
                <p class="text-sm text-[#3D3D3B]/70 font-medium">
                    Buku Terlambat
                </p>
                <p class="text-3xl font-bold text-red-500 mt-2">
                    {{ $terlambat }}
                </p>
            </div>

        </div>

        {{-- Aktivitas Terbaru --}}
        <div class="bg-[#E8E8E8] rounded-2xl border border-[#BBBFCA] shadow-sm overflow-hidden">

            <div class="px-6 py-4 border-b border-[#BBBFCA] bg-[#F4F4F2]">
                <h3 class="font-bold text-[#3D3D3B]">
                    Aktivitas Peminjaman Terbaru
                </h3>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">

                    <thead>
                        <tr class="border-b border-[#BBBFCA] text-[#3D3D3B]/70">
                            <th class="px-6 py-4">User</th>
                            <th class="px-6 py-4">Buku</th>
                            <th class="px-6 py-4">Jatuh Tempo</th>
                            <th class="px-6 py-4">Status</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($latestPeminjaman as $item)
                            <tr class="border-b border-[#BBBFCA]/50 hover:bg-[#F4F4F2] transition-all duration-300">

                                <td class="px-6 py-4 font-medium text-[#3D3D3B]">
                                    {{ $item->peminjam->nama }}
                                </td>

                                <td class="px-6 py-4 text-[#3D3D3B]">
                                    {{ $item->buku->judul_buku }}
                                </td>

                                <td class="px-6 py-4 text-[#3D3D3B]/70">
                                    {{ \Carbon\Carbon::parse($item->tanggal_jatuh_tempo)->format('d M Y') }}
                                </td>

                                <td class="px-6 py-4">

                                    @if($item->tanggal_kembali)
                                        <span
                                            class="px-3 py-1 text-xs rounded-full bg-green-100 text-green-600 font-semibold">
                                            Dikembalikan
                                        </span>

                                    @elseif($item->tanggal_jatuh_tempo < now())
                                        <span
                                            class="px-3 py-1 text-xs rounded-full bg-red-100 text-red-600 font-semibold">
                                            Terlambat
                                        </span>

                                    @else
                                        <span
                                            class="px-3 py-1 text-xs rounded-full bg-yellow-100 text-yellow-600 font-semibold">
                                            Dipinjam
                                        </span>
                                    @endif

                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="py-6 text-center text-[#3D3D3B]/50">
                                    Belum ada aktivitas peminjaman.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>

        </div>

        {{-- Quick Actions --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">

            {{-- Kelola Buku --}}
            <a href="{{ route('admin.data-buku.index') }}"
                class="flex items-center justify-center gap-2 py-4 rounded-2xl bg-[#3D3D3B] text-white font-semibold shadow-sm hover:opacity-90 active:scale-[0.98] transition-all duration-300">

                Kelola Buku
            </a>

            {{-- Kelola Kategori --}}
            <a href="{{ route('admin.data-kategori.index') }}"
                class="flex items-center justify-center gap-2 py-4 rounded-2xl bg-[#E8E8E8] border border-[#BBBFCA] text-[#3D3D3B] font-semibold shadow-sm hover:bg-[#F4F4F2] active:scale-[0.98] transition-all duration-300">

                Kelola Kategori
            </a>

            {{-- Monitoring --}}
            <a href="{{ route('admin.riwayat-peminjaman') }}"
                class="flex items-center justify-center gap-2 py-4 rounded-2xl bg-[#E8E8E8] border border-red-200 text-red-500 font-semibold shadow-sm hover:bg-red-50 active:scale-[0.98] transition-all duration-300">

                Monitoring Peminjaman
            </a>

        </div>

    </div>
</x-app-layout>
