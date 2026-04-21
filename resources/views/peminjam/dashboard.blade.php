<x-app-layout>
    <x-slot name="header">
        Dashboard Perpustakaan Digital
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6" style="background-color: #f0f4f8;">

        <!-- Welcome -->
        <div class="bg-white rounded-2xl shadow-sm p-6"
            style="background: linear-gradient(135deg, #1557b0 0%, #1a73e8 55%, #4da3ff 100%);">
            <h3 class="text-lg font-bold text-white">
                Halo, {{ Auth::user()->nama }} 👋
            </h3>
            <p class="text-sm text-white/80 mt-1">
                Berikut ringkasan aktivitas peminjaman kamu hari ini.
            </p>
        </div>

        <!-- Statistik -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-5">

            <div class="bg-white p-6 rounded-2xl shadow-sm border-t-4 border-[#1a73e8]">
                <p class="text-sm text-gray-500">Buku Aktif</p>
                <p class="text-3xl font-bold text-[#1a73e8] mt-2">{{ $bukuAktif }}</p>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow-sm border-t-4 border-yellow-400">
                <p class="text-sm text-gray-500">Hampir Jatuh Tempo</p>
                <p class="text-3xl font-bold text-yellow-500 mt-2">{{ $hampirJatuhTempo }}</p>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow-sm border-t-4 border-[#4da3ff]">
                <p class="text-sm text-gray-500">Total Riwayat</p>
                <p class="text-3xl font-bold text-[#1a73e8] mt-2">{{ $totalRiwayat }}</p>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow-sm border-t-4 border-red-500">
                <p class="text-sm text-gray-500">Total Denda</p>
                <p class="text-3xl font-bold text-red-500 mt-2">
                    Rp {{ number_format($totalDenda, 0, ',', '.') }}
                </p>
                @if($totalDenda > 0)
                <p class="text-xs text-red-400 mt-1">
                    {{ $dendaBelumBayar->count() }} buku memiliki denda
                </p>
                @endif
            </div>

        </div>

        <!-- Alert Jatuh Tempo -->
        @if($peringatanJatuhTempo->count())
        <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 rounded-xl">
            <p class="text-sm font-semibold text-yellow-700 mb-2">⚠️ Peringatan Jatuh Tempo</p>
            <ul class="text-sm text-yellow-700 space-y-1">
                @foreach($peringatanJatuhTempo as $item)
                <li>
                    {{ $item->buku->judul_buku }} —
                    jatuh tempo {{ \Carbon\Carbon::parse($item->tanggal_jatuh_tempo)->format('d M Y') }}
                </li>
                @endforeach
            </ul>
        </div>
        @endif

        @if($terlambat > 0)
        <div class="bg-red-50 border-l-4 border-red-400 p-4 rounded-xl">
            <p class="text-sm font-semibold text-red-700">
                ⚠️ Kamu memiliki {{ $terlambat }} buku terlambat.
            </p>
        </div>
        @endif

        <!-- Buku Sedang Dipinjam -->
        <div class="bg-white rounded-2xl shadow-sm overflow-hidden">

            <div class="px-6 py-4 border-b border-gray-100">
                <h3 class="font-bold text-base text-gray-800">Buku Sedang Dipinjam</h3>
            </div>

            <div class="p-6 space-y-3">
                @forelse($bukuDipinjam as $pinjam)
                <div class="flex items-center justify-between border border-gray-100 rounded-xl p-4 hover:shadow-sm transition">
                    <div>
                        <p class="font-semibold text-gray-800 text-sm">
                            {{ $pinjam->buku->judul_buku }}
                        </p>
                        <p class="text-xs text-gray-400 mt-0.5">
                            Jatuh tempo: {{ \Carbon\Carbon::parse($pinjam->tanggal_jatuh_tempo)->format('d M Y') }}
                        </p>
                    </div>

                    @php
                        $hariIni = \Carbon\Carbon::now()->startOfDay();
                        $jatuhTempo = \Carbon\Carbon::parse($pinjam->tanggal_jatuh_tempo)->startOfDay();
                        $sisaHari = $hariIni->diffInDays($jatuhTempo, false);
                    @endphp

                    @if($sisaHari < 0)
                    <span class="px-3 py-1 text-xs rounded-full bg-red-100 text-red-600 font-semibold">
                        Terlambat {{ abs($sisaHari) }} Hari
                    </span>
                    @elseif($sisaHari <= 1)
                    <span class="px-3 py-1 text-xs rounded-full bg-yellow-100 text-yellow-600 font-semibold">
                        {{ $sisaHari }} Hari Lagi
                    </span>
                    @else
                    <span class="px-3 py-1 text-xs rounded-full bg-blue-50 text-[#1a73e8] font-semibold">
                        Aman
                    </span>
                    @endif
                </div>
                @empty
                <p class="text-sm text-gray-400">Tidak ada buku sedang dipinjam.</p>
                @endforelse
            </div>

        </div>

        <!-- Buku Favorit -->
        <div class="bg-white rounded-2xl shadow-sm overflow-hidden">

            <div class="px-6 py-4 border-b border-gray-100">
                <h3 class="font-bold text-base text-gray-800">Buku Favorit Saya</h3>
            </div>

            <div class="p-6">
                @if($bukuFavorit->count())
                <div class="flex gap-4 overflow-x-auto pb-2">
                    @foreach($bukuFavorit as $buku)
                    <a href="{{ route('peminjam.buku.detail', $buku->id) }}"
                        class="min-w-[140px] bg-gray-50 rounded-xl shadow-sm hover:shadow-md transition overflow-hidden">
                        <img src="{{ $buku->cover ? asset('storage/cover-buku/'.$buku->cover) : asset('images/default-book.png') }}"
                            class="h-40 w-full object-cover">
                        <div class="p-3">
                            <p class="text-xs font-semibold text-gray-700 line-clamp-2">{{ $buku->judul_buku }}</p>
                        </div>
                    </a>
                    @endforeach
                </div>
                @else
                <p class="text-sm text-gray-400">Belum ada buku favorit.</p>
                @endif
            </div>

        </div>

        <!-- Quick Actions -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">

            <a href="{{ route('peminjam.buku.index') }}"
                class="flex items-center justify-center gap-2 py-4 rounded-2xl font-semibold text-sm text-white shadow-sm transition hover:opacity-90"
                style="background: linear-gradient(135deg, #1557b0 0%, #1a73e8 55%, #4da3ff 100%);">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                Cari Buku
            </a>

            <a href="{{ route('peminjam.riwayat-peminjaman.index') }}"
                class="flex items-center justify-center gap-2 py-4 rounded-2xl font-semibold text-sm text-[#1a73e8] bg-white border border-[#1a73e8]/30 hover:bg-blue-50 transition shadow-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                Lihat Riwayat
            </a>

            <button onclick="openDendaModal()"
                class="flex items-center justify-center gap-2 py-4 rounded-2xl font-semibold text-sm text-red-500 bg-white border border-red-300 hover:bg-red-50 transition shadow-sm w-full">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 9v2m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z" />
                </svg>
                Lihat Denda
            </button>

        </div>

        <!-- Kuota Pinjam -->
        <div class="bg-white rounded-2xl shadow-sm p-6">
            <div class="flex items-center justify-between mb-2">
                <p class="text-sm text-gray-600 font-medium">
                    📚 Kuota Peminjaman
                </p>
                <p class="text-sm font-bold text-[#1a73e8]">
                    {{ $bukuAktif }} / {{ $maksimalPinjam }} buku
                </p>
            </div>
            <div class="w-full bg-gray-100 rounded-full h-3">
                <div class="h-3 rounded-full transition-all duration-500"
                    style="width: {{ $persentaseKuota }}%; background: linear-gradient(90deg, #1557b0, #4da3ff);">
                </div>
            </div>
        </div>

    </div>

    <!-- Modal Denda -->
    <div id="dendaModal" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50 px-4">
        <div class="bg-white w-full max-w-lg rounded-2xl shadow-xl overflow-hidden">

            {{-- Modal Header --}}
            <div class="px-6 py-5"
                style="background: linear-gradient(135deg, #1557b0 0%, #1a73e8 55%, #4da3ff 100%);">
                <h2 class="text-base font-bold text-white">Detail Denda</h2>
            </div>

            <div class="p-6">
                @if($dendaBelumBayar->count())
                <div class="space-y-3 max-h-64 overflow-y-auto">
                    @foreach($dendaBelumBayar as $item)
                    <div class="border border-gray-100 rounded-xl p-4">
                        <p class="font-semibold text-gray-800 text-sm">{{ $item->buku->judul_buku }}</p>
                        <p class="text-xs text-gray-400 mt-0.5">
                            Jatuh Tempo: {{ $item->tanggal_jatuh_tempo->format('d M Y') }}
                        </p>
                        <p class="text-sm text-red-500 font-semibold mt-1">
                            Denda: Rp {{ number_format($item->denda, 0, ',', '.') }}
                        </p>
                        <p class="text-xs text-gray-400 mt-0.5">
                            Status: {{ ucwords(str_replace('_', ' ', $item->status_pembayaran)) }}
                        </p>
                    </div>
                    @endforeach
                </div>
                <div class="mt-4 border-t border-gray-100 pt-4 flex items-center justify-between">
                    <p class="text-sm text-gray-500">Total Denda</p>
                    <p class="font-bold text-red-500">Rp {{ number_format($totalDenda, 0, ',', '.') }}</p>
                </div>
                @else
                <p class="text-sm text-gray-400 text-center py-4">Tidak ada denda aktif.</p>
                @endif

                <div class="flex justify-end mt-4">
                    <button onclick="closeDendaModal()"
                        class="px-5 py-2 rounded-xl text-sm font-semibold text-gray-600 bg-gray-100 hover:bg-gray-200 transition">
                        Tutup
                    </button>
                </div>
            </div>

        </div>
    </div>

    <script>
        function openDendaModal() {
            document.getElementById('dendaModal').classList.remove('hidden');
            document.getElementById('dendaModal').classList.add('flex');
        }
        function closeDendaModal() {
            document.getElementById('dendaModal').classList.add('hidden');
            document.getElementById('dendaModal').classList.remove('flex');
        }
    </script>

</x-app-layout>
