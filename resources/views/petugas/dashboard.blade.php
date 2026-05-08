<x-app-layout>
    <x-slot name="header">
        <div class="bg-[#3D3D3B] rounded-3xl p-8 shadow-sm border border-[#E7E5E4]">

            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

                <div>
                    <h1 class="text-2xl font-bold text-white">
                        Halo, {{ Auth::user()->nama }} 👋
                    </h1>

                    <p class="text-sm text-gray-300 mt-2">
                        Dashboard operasional perpustakaan untuk memantau aktivitas harian.
                    </p>
                </div>

                <div class="bg-white/10 rounded-2xl px-4 py-3 border border-white/10">
                    <p class="text-xs text-gray-300">
                        Hari Operasional
                    </p>
                    <p class="text-sm font-semibold text-white">
                        {{ now()->translatedFormat('d F Y') }}
                    </p>
                </div>

            </div>

        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-8 space-y-8">

        {{-- Statistik --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

            {{-- Peminjaman Aktif --}}
            <div
                class="bg-white rounded-3xl p-6 shadow-sm border border-[#E7E5E4] border-l-4 border-l-[#3D3D3B] hover:shadow-md transition">

                <p class="text-sm text-gray-500">
                    Peminjaman Aktif
                </p>

                <p class="text-3xl font-bold text-[#3D3D3B] mt-3">
                    {{ $peminjamanAktif }}
                </p>

            </div>

            {{-- Menunggu Validasi --}}
            <div
                class="bg-white rounded-3xl p-6 shadow-sm border border-[#E7E5E4] border-l-4 border-l-[#5C5C5B] hover:shadow-md transition">

                <p class="text-sm text-gray-500">
                    Menunggu Validasi
                </p>

                <p class="text-3xl font-bold text-[#3D3D3B] mt-3">
                    {{ $menungguValidasi }}
                </p>

            </div>

            {{-- Buku Terlambat --}}
            <div
                class="bg-white rounded-3xl p-6 shadow-sm border border-[#FECACA] border-l-4 border-l-red-500 hover:shadow-md transition">

                <p class="text-sm text-gray-500">
                    Buku Terlambat
                </p>

                <p class="text-3xl font-bold text-red-500 mt-3">
                    {{ $terlambat }}
                </p>

            </div>

            {{-- Total Buku --}}
            <div
                class="bg-white rounded-3xl p-6 shadow-sm border border-[#E7E5E4] border-l-4 border-l-[#3D3D3B] hover:shadow-md transition">

                <p class="text-sm text-gray-500">
                    Total Buku
                </p>

                <p class="text-3xl font-bold text-[#3D3D3B] mt-3">
                    {{ $totalBuku }}
                </p>

            </div>

        </div>

        {{-- Main Grid --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            {{-- Prioritas Operasional --}}
            <div class="lg:col-span-2 bg-white rounded-3xl shadow-sm border border-[#E7E5E4] p-6">

                <div class="mb-6">
                    <h3 class="text-lg font-bold text-[#3D3D3B]">
                        Prioritas Operasional
                    </h3>

                    <p class="text-sm text-gray-500 mt-1">
                        Tugas yang perlu diprioritaskan hari ini.
                    </p>
                </div>

                <div class="space-y-4">

                    @if($menungguValidasi > 0)
                    <div
                        class="flex justify-between items-center p-5 rounded-2xl bg-[#FAFAF9] border border-[#E7E5E4] hover:bg-white transition">

                        <div>
                            <p class="font-semibold text-[#3D3D3B]">
                                {{ $menungguValidasi }} peminjaman menunggu validasi
                            </p>

                            <p class="text-sm text-gray-500 mt-1">
                                Segera verifikasi permintaan peminjaman.
                            </p>
                        </div>

                        <a href="{{ route('petugas.validasi-peminjaman.index') }}"
                            class="text-sm font-semibold text-[#3D3D3B] hover:underline">
                            Proses →
                        </a>

                    </div>
                    @endif

                    @if($terlambat > 0)
                    <div
                        class="flex justify-between items-center p-5 rounded-2xl bg-red-50 border border-red-100 hover:bg-red-100 transition">

                        <div>
                            <p class="font-semibold text-red-600">
                                {{ $terlambat }} buku terlambat dikembalikan
                            </p>

                            <p class="text-sm text-red-400 mt-1">
                                Perlu tindak lanjut segera.
                            </p>
                        </div>

                        <a href="{{ route('petugas.data-peminjaman.index') }}"
                            class="text-sm font-semibold text-red-500 hover:underline">
                            Lihat →
                        </a>

                    </div>
                    @endif

                    @if($menungguValidasi == 0 && $terlambat == 0)
                    <div
                        class="text-center py-12 rounded-2xl border border-[#E7E5E4] bg-[#FAFAF9]">

                        <p class="font-semibold text-[#3D3D3B]">
                            Tidak ada prioritas mendesak
                        </p>

                        <p class="text-sm text-gray-500 mt-2">
                            Semua aktivitas perpustakaan berjalan normal.
                        </p>

                    </div>
                    @endif

                </div>

            </div>

            {{-- Aktivitas Hari Ini --}}
            <div class="bg-white rounded-3xl shadow-sm border border-[#E7E5E4] p-6">

                <div class="mb-6">
                    <h3 class="text-lg font-bold text-[#3D3D3B]">
                        Aktivitas Hari Ini
                    </h3>

                    <p class="text-sm text-gray-500 mt-1">
                        Ringkasan aktivitas operasional hari ini.
                    </p>
                </div>

                <div class="space-y-5 text-sm">

                    @if($pengembalianHariIni > 0)
                    <div class="flex justify-between items-center border-b border-[#E7E5E4] pb-3">
                        <span class="text-gray-600">
                            📚 Pengembalian Diproses
                        </span>

                        <span class="font-bold text-[#3D3D3B]">
                            {{ $pengembalianHariIni }}
                        </span>
                    </div>
                    @endif

                    @if($bukuHariIni > 0)
                    <div class="flex justify-between items-center border-b border-[#E7E5E4] pb-3">
                        <span class="text-gray-600">
                            📝 Buku Ditambahkan
                        </span>

                        <span class="font-bold text-[#3D3D3B]">
                            {{ $bukuHariIni }}
                        </span>
                    </div>
                    @endif

                    @if($ulasanHariIni > 0)
                    <div class="flex justify-between items-center border-b border-[#E7E5E4] pb-3">
                        <span class="text-gray-600">
                            ⭐ Ulasan Masuk
                        </span>

                        <span class="font-bold text-[#3D3D3B]">
                            {{ $ulasanHariIni }}
                        </span>
                    </div>
                    @endif

                    @if($pengembalianHariIni == 0 && $bukuHariIni == 0 && $ulasanHariIni == 0)
                    <div class="text-center py-8">
                        <p class="text-gray-400">
                            Belum ada aktivitas hari ini
                        </p>
                    </div>
                    @endif

                </div>

            </div>

        </div>

        {{-- Quick Actions --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            {{-- Primary --}}
            <a href="{{ route('petugas.data-buku.create') }}"
                class="bg-[#3D3D3B] text-white p-5 rounded-3xl text-center font-semibold shadow-sm hover:bg-[#2F2F2E] transition">

                + Tambah Buku

            </a>

            {{-- Secondary --}}
            <a href="{{ route('petugas.validasi-peminjaman.index') }}"
                class="bg-white border border-[#D6D3D1] text-[#3D3D3B] p-5 rounded-3xl text-center font-semibold hover:bg-[#FAFAF9] transition">

                Validasi Peminjaman

            </a>

            {{-- Danger --}}
            <a href="{{ route('petugas.data-ulasan.index') }}"
                class="bg-white border border-red-200 text-red-500 p-5 rounded-3xl text-center font-semibold hover:bg-red-50 transition">

                Moderasi Ulasan

            </a>

        </div>

    </div>
</x-app-layout>