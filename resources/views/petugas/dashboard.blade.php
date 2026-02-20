<x-app-layout>
    <x-slot name="header">
        <div class="bg-[#09637E] rounded-2xl p-8 shadow-md border border-gray-100">
            <h1 class="text-2xl font-bold text-white">
                Halo, {{ Auth::user()->nama }} 👋
            </h1>
            <p class="text-sm text-white mt-2">
                Control Center Operasional Perpustakaan Hari Ini
            </p>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8 mt-8">

        <!-- Statistik -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">

            <div class="bg-white rounded-2xl p-6 shadow-md hover:shadow-xl transition border border-[#7AB2B2]/20">
                <p class="text-sm text-gray-500">Peminjaman Aktif</p>
                <p class="text-3xl font-bold text-[#09637E] mt-2">{{ $peminjamanAktif }}</p>
            </div>

            <div class="bg-white rounded-2xl p-6 shadow-md hover:shadow-xl transition border border-[#7AB2B2]/20">
                <p class="text-sm text-gray-500">Menunggu Validasi</p>
                <p class="text-3xl font-bold text-[#088395] mt-2"> {{ $menungguValidasi }}</p>
            </div>

            <div class="bg-white rounded-2xl p-6 shadow-md hover:shadow-xl transition border border-red-200">
                <p class="text-sm text-gray-500">Buku Terlambat</p>
                <p class="text-3xl font-bold text-red-500 mt-2">{{ $terlambat }}</p>
            </div>

            <div class="bg-white rounded-2xl p-6 shadow-md hover:shadow-xl transition border border-[#7AB2B2]/20">
                <p class="text-sm text-gray-500">Total Buku</p>
                <p class="text-3xl font-bold text-[#09637E] mt-2">{{ $totalBuku }}</p>
            </div>

        </div>

        <!-- Grid Operasional -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            <!-- Prioritas -->
            <div class="lg:col-span-2 bg-white rounded-2xl shadow-md p-6">
                <h3 class="text-lg font-semibold text-[#09637E] mb-6">
                    Prioritas Operasional
                </h3>

                <div class="space-y-4">

                    @if($menungguValidasi > 0)
                    <div
                        class="flex justify-between items-center p-4 rounded-xl bg-[#EBF4F6] hover:bg-[#7AB2B2]/20 transition">
                        <div>
                            <p class="font-medium">
                                {{ $menungguValidasi }} peminjaman perlu diverifikasi
                            </p>
                            <p class="text-xs text-gray-500">Segera diproses</p>
                        </div>
                        <a href="{{ route('petugas.validasi-peminjaman.index') }}"
                            class="text-[#09637E] font-semibold text-sm">
                            Proses →
                        </a>
                    </div>
                    @endif

                    @if($terlambat > 0)
                    <div class="flex justify-between items-center p-4 rounded-xl bg-red-50 hover:bg-red-100 transition">
                        <div>
                            <p class="font-medium text-red-600">
                                {{ $terlambat }} buku terlambat dikembalikan
                            </p>
                            <p class="text-xs text-red-400">Perlu tindak lanjut</p>
                        </div>
                        <a href="{{ route('petugas.data-peminjaman.index') }}"
                            class="text-red-500 font-semibold text-sm">
                            Lihat →
                        </a>
                    </div>
                    @endif

                    {{-- EMPTY STATE --}}
                    @if($menungguValidasi == 0 && $terlambat == 0)

                    <div class="text-center py-10 border border-[#7AB2B2]/30 rounded-2xl bg-[#EBF4F6]">
                        <p class="font-semibold text-[#09637E]">
                            Tidak Ada Prioritas Mendesak
                        </p>

                        <p class="text-sm text-gray-500 mt-1">
                            Semua peminjaman dalam kondisi terkendali.
                        </p>
                    </div>

                    @endif

                </div>
            </div>

            <!-- Aktivitas Hari Ini -->

            <div class="bg-white rounded-2xl shadow-md p-6">
                <h3 class="text-lg font-semibold text-[#09637E] mb-6">
                    Aktivitas Hari Ini
                </h3>

                <div class="bg-white rounded-2xl shadow-md p-6">
                    <div class="space-y-4 text-sm">

                        @if($pengembalianHariIni > 0)
                        <div class="flex justify-between">
                            <span class="text-gray-600">📚 Pengembalian Diproses</span>
                            <span class="font-semibold text-[#09637E]">
                                {{ $pengembalianHariIni }}
                            </span>
                        </div>
                        @endif

                        @if($bukuHariIni > 0)
                        <div class="flex justify-between">
                            <span class="text-gray-600">📝 Buku Ditambahkan</span>
                            <span class="font-semibold text-[#09637E]">
                                {{ $bukuHariIni }}
                            </span>
                        </div>
                        @endif

                        @if($ulasanHariIni > 0)
                        <div class="flex justify-between">
                            <span class="text-gray-600">⭐ Ulasan Masuk</span>
                            <span class="font-semibold text-[#09637E]">
                                {{ $ulasanHariIni }}
                            </span>
                        </div>
                        @endif

                        @if($pengembalianHariIni == 0 && $bukuHariIni == 0 && $ulasanHariIni == 0)
                        <p class="text-gray-400 text-center">
                            Belum ada aktivitas hari ini
                        </p>
                        @endif

                    </div>
                </div>
            </div>





        </div>

        <!-- Quick Actions -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            <a href="{{ route('petugas.data-buku.create') }}"
                class="bg-[#09637E] text-white p-5 rounded-2xl text-center font-semibold shadow-md hover:bg-[#088395] transition">
                + Tambah Buku
            </a>

            <a href="{{ route('petugas.validasi-peminjaman.index') }}"
                class="bg-white border border-[#09637E] text-[#09637E] p-5 rounded-2xl text-center font-semibold hover:bg-[#EBF4F6] transition">
                Validasi Peminjaman
            </a>

            <a href="{{ route('petugas.data-ulasan.index') }}"
                class="bg-white border border-red-400 text-red-500 p-5 rounded-2xl text-center font-semibold hover:bg-red-50 transition">
                Moderasi Ulasan
            </a>

        </div>

    </div>
</x-app-layout>
