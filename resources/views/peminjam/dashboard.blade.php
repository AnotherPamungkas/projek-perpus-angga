<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 space-y-6 bg-[#F4F4F2] min-h-screen">

        {{-- Welcome Section --}}
        <div class="bg-[#3D3D3B] rounded-2xl shadow-md p-6 border border-[#BBBFCA]">
            <h3 class="text-xl font-bold text-white">
                Halo, {{ Auth::user()->nama }} 👋
            </h3>
            <p class="text-sm text-[#E8E8E8] mt-1">
                Berikut ringkasan aktivitas peminjaman buku kamu hari ini.
            </p>
        </div>

        {{-- Statistik --}}
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-5">

            {{-- Buku Aktif --}}
            <div
                class="bg-[#E8E8E8] p-5 rounded-2xl border border-[#BBBFCA] border-t-4 border-t-[#3D3D3B] shadow-sm hover:shadow-md transition-all duration-300 hover:-translate-y-0.5">
                <p class="text-sm text-[#3D3D3B]/70 font-medium">
                    Buku Aktif
                </p>
                <p class="text-3xl font-bold text-[#3D3D3B] mt-2">
                    {{ $bukuAktif }}
                </p>
            </div>

            {{-- Hampir Jatuh Tempo --}}
            <div
                class="bg-[#E8E8E8] p-5 rounded-2xl border border-[#BBBFCA] border-t-4 border-t-yellow-500 shadow-sm hover:shadow-md transition-all duration-300 hover:-translate-y-0.5">
                <p class="text-sm text-[#3D3D3B]/70 font-medium">
                    Hampir Jatuh Tempo
                </p>
                <p class="text-3xl font-bold text-yellow-500 mt-2">
                    {{ $hampirJatuhTempo }}
                </p>
            </div>

            {{-- Total Riwayat --}}
            <div
                class="bg-[#E8E8E8] p-5 rounded-2xl border border-[#BBBFCA] border-t-4 border-t-[#BBBFCA] shadow-sm hover:shadow-md transition-all duration-300 hover:-translate-y-0.5">
                <p class="text-sm text-[#3D3D3B]/70 font-medium">
                    Total Riwayat
                </p>
                <p class="text-3xl font-bold text-[#3D3D3B] mt-2">
                    {{ $totalRiwayat }}
                </p>
            </div>

            {{-- Total Denda --}}
            <div
                class="bg-[#E8E8E8] p-5 rounded-2xl border border-[#BBBFCA] border-t-4 border-t-red-500 shadow-sm hover:shadow-md transition-all duration-300 hover:-translate-y-0.5">
                <p class="text-sm text-[#3D3D3B]/70 font-medium">
                    Total Denda
                </p>
                <p class="text-2xl font-bold text-red-500 mt-2">
                    Rp {{ number_format($totalDenda, 0, ',', '.') }}
                </p>

                @if($totalDenda > 0)
                <p class="text-xs text-red-400 mt-2">
                    {{ $dendaBelumBayar->count() }} buku memiliki denda
                </p>
                @endif
            </div>

        </div>

        {{-- Alert Jatuh Tempo --}}
        @if($peringatanJatuhTempo->count())
        <div class="bg-yellow-50 border border-yellow-200 rounded-2xl p-5 shadow-sm">
            <p class="text-sm font-semibold text-yellow-700 mb-3">
                ⚠️ Peringatan Jatuh Tempo
            </p>

            <ul class="space-y-2 text-sm text-yellow-700">
                @foreach($peringatanJatuhTempo as $item)
                <li class="flex justify-between border-b border-yellow-100 pb-2">
                    <span>{{ $item->buku->judul_buku }}</span>
                    <span>
                        {{ \Carbon\Carbon::parse($item->tanggal_jatuh_tempo)->format('d M Y') }}
                    </span>
                </li>
                @endforeach
            </ul>
        </div>
        @endif

        {{-- Alert Buku Terlambat --}}
        @if($terlambat > 0)
        <div class="bg-red-50 border border-red-200 rounded-2xl p-5 shadow-sm">
            <p class="text-sm font-semibold text-red-700">
                ⚠️ Kamu memiliki {{ $terlambat }} buku yang terlambat dikembalikan.
            </p>
        </div>
        @endif

        {{-- Buku Sedang Dipinjam --}}
        <div class="bg-[#E8E8E8] rounded-2xl border border-[#BBBFCA] shadow-sm overflow-hidden">

            <div class="px-6 py-4 border-b border-[#BBBFCA] bg-[#F4F4F2]">
                <h3 class="font-bold text-[#3D3D3B]">
                    Buku Sedang Dipinjam
                </h3>
            </div>

            <div class="p-6 space-y-3">

                @forelse($bukuDipinjam as $pinjam)
                <div
                    class="flex items-center justify-between border border-[#BBBFCA] rounded-xl p-4 hover:bg-[#F4F4F2] transition-all duration-300">

                    <div>
                        <p class="font-semibold text-[#3D3D3B] text-sm">
                            {{ $pinjam->buku->judul_buku }}
                        </p>

                        <p class="text-xs text-[#3D3D3B]/50 mt-1">
                            Jatuh tempo:
                            {{ \Carbon\Carbon::parse($pinjam->tanggal_jatuh_tempo)->format('d M Y') }}
                        </p>
                    </div>

                    @php
                    $hariIni = \Carbon\Carbon::now()->startOfDay();
                    $jatuhTempo = \Carbon\Carbon::parse($pinjam->tanggal_jatuh_tempo)->startOfDay();
                    $sisaHari = $hariIni->diffInDays($jatuhTempo, false);
                    @endphp

                    @if($sisaHari < 0) <span
                        class="px-3 py-1 text-xs rounded-full bg-red-100 text-red-600 font-semibold">
                        Terlambat {{ abs($sisaHari) }} Hari
                        </span>
                        @elseif($sisaHari <= 1) <span
                            class="px-3 py-1 text-xs rounded-full bg-yellow-100 text-yellow-600 font-semibold">
                            {{ $sisaHari }} Hari Lagi
                            </span>
                            @else
                            <span class="px-3 py-1 text-xs rounded-full bg-[#BBBFCA]/20 text-[#3D3D3B] font-semibold">
                                Aman
                            </span>
                            @endif

                </div>
                @empty
                <p class="text-sm text-[#3D3D3B]/50">
                    Tidak ada buku sedang dipinjam.
                </p>
                @endforelse

            </div>

        </div>

        {{-- Buku Favorit --}}
        <div class="bg-[#E8E8E8] rounded-2xl border border-[#BBBFCA] shadow-sm overflow-hidden">

            <div class="px-6 py-4 border-b border-[#BBBFCA] bg-[#F4F4F2]">
                <h3 class="font-bold text-[#3D3D3B]">
                    Buku Favorit Saya
                </h3>
            </div>

            <div class="p-6">

                @if($bukuFavorit->count())
                <div class="flex gap-4 overflow-x-auto pb-2">

                    @foreach($bukuFavorit as $buku)
                    <a href="{{ route('peminjam.buku.detail', $buku->id) }}"
                        class="min-w-[160px] bg-[#F4F4F2] border border-[#BBBFCA] rounded-2xl overflow-hidden hover:shadow-md transition-all duration-300">

                        <img src="{{ $buku->cover
                                    ? asset('storage/cover-buku/'.$buku->cover)
                                    : asset('images/default-book.png') }}" class="h-44 w-full object-cover">

                        <div class="p-3">
                            <p class="text-sm font-semibold text-[#3D3D3B] line-clamp-2">
                                {{ $buku->judul_buku }}
                            </p>
                        </div>

                    </a>
                    @endforeach

                </div>
                @else
                <p class="text-sm text-[#3D3D3B]/50">
                    Belum ada buku favorit.
                </p>
                @endif

            </div>

        </div>

        {{-- Quick Actions --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">

            {{-- Cari Buku --}}
            <a href="{{ route('peminjam.buku.index') }}"
                class="flex items-center justify-center gap-2 py-4 rounded-2xl bg-[#3D3D3B] text-white font-semibold shadow-sm hover:opacity-90 active:scale-[0.98] transition-all duration-300">

                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>

                Cari Buku
            </a>

            {{-- Riwayat --}}
            <a href="{{ route('peminjam.riwayat-peminjaman.index') }}"
                class="flex items-center justify-center gap-2 py-4 rounded-2xl bg-[#E8E8E8] border border-[#BBBFCA] text-[#3D3D3B] font-semibold shadow-sm hover:bg-[#F4F4F2] active:scale-[0.98] transition-all duration-300">

                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>

                Lihat Riwayat
            </a>

            {{-- Denda --}}
            <button onclick="openDendaModal()"
                class="flex items-center justify-center gap-2 py-4 rounded-2xl bg-[#E8E8E8] border border-red-200 text-red-500 font-semibold shadow-sm hover:bg-red-50 active:scale-[0.98] transition-all duration-300 w-full">

                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 9v2m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z" />
                </svg>

                Lihat Denda
            </button>

        </div>

    </div>

    {{-- Modal Denda --}}
    <div id="dendaModal" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50 px-4">

        <div class="bg-[#F4F4F2] w-full max-w-lg rounded-2xl shadow-xl overflow-hidden">

            {{-- Header Modal --}}
            <div class="px-6 py-5 bg-[#3D3D3B]">
                <h2 class="text-base font-bold text-white">
                    Detail Denda
                </h2>
            </div>

            {{-- Content --}}
            <div class="p-6">

                @if($dendaBelumBayar->count())

                <div class="space-y-3 max-h-64 overflow-y-auto">

                    @foreach($dendaBelumBayar as $item)
                    <div class="border border-[#BBBFCA] rounded-xl p-4 bg-[#E8E8E8]">

                        <p class="font-semibold text-[#3D3D3B] text-sm">
                            {{ $item->buku->judul_buku }}
                        </p>

                        <p class="text-xs text-[#3D3D3B]/50 mt-1">
                            Jatuh Tempo:
                            {{ $item->tanggal_jatuh_tempo->format('d M Y') }}
                        </p>

                        <p class="text-sm text-red-500 font-semibold mt-2">
                            Denda:
                            Rp {{ number_format($item->denda, 0, ',', '.') }}
                        </p>

                        <p class="text-xs text-[#3D3D3B]/50 mt-1">
                            Status:
                            {{ ucwords(str_replace('_', ' ', $item->status_pembayaran)) }}
                        </p>

                        <div class="mt-4">
                            <button onclick="openQrModal('{{ route('peminjam.pembayaran.show', $item->id) }}')"
                                class="w-full inline-flex justify-center items-center px-4 py-2 rounded-xl bg-[#3D3D3B] text-white text-sm font-semibold hover:opacity-90 transition">
                                Bayar via QR
                            </button>
                        </div>
                    </div>
                    @endforeach

                </div>

                <div class="mt-5 border-t border-[#BBBFCA] pt-4 flex items-center justify-between">
                    <p class="text-sm text-[#3D3D3B]/70">
                        Total Denda
                    </p>

                    <p class="font-bold text-red-500">
                        Rp {{ number_format($totalDenda, 0, ',', '.') }}
                    </p>
                </div>

                @else
                <p class="text-sm text-[#3D3D3B]/50 text-center py-4">
                    Tidak ada denda aktif.
                </p>
                @endif

                {{-- Button Close --}}
                <div class="flex justify-end mt-6">
                    <button onclick="closeDendaModal()"
                        class="px-5 py-2 rounded-xl text-sm font-semibold text-[#3D3D3B] bg-[#E8E8E8] hover:bg-[#BBBFCA] transition-all duration-300">
                        Tutup
                    </button>
                </div>

            </div>

        </div>

    </div>

    {{-- Modal QR --}}
    <div id="qrModal" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50 px-4">

        <div class="bg-[#F4F4F2] w-full max-w-md rounded-2xl shadow-xl overflow-hidden">

            {{-- Header --}}
            <div class="px-6 py-5 bg-[#3D3D3B]">
                <h2 class="text-base font-bold text-white">
                    Scan QR untuk Pembayaran
                </h2>
            </div>

            {{-- Content --}}
            <div class="p-6 text-center">

                <img id="qrImage" src="" alt="QR Code" class="mx-auto w-64 h-64 rounded-xl border border-[#BBBFCA]">

                <p class="text-sm text-[#3D3D3B]/60 mt-4">
                    Scan QR ini untuk membuka halaman pembayaran.
                </p>

                <div class="mt-6">
                    <button onclick="closeQrModal()"
                        class="px-5 py-2 rounded-xl bg-[#E8E8E8] text-[#3D3D3B] font-semibold hover:bg-[#BBBFCA] transition">
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

        function openQrModal(paymentUrl) {
            const qrUrl =
                `https://api.qrserver.com/v1/create-qr-code/?size=250x250&data=${encodeURIComponent(paymentUrl)}`;

            document.getElementById('qrImage').src = qrUrl;

            document.getElementById('qrModal').classList.remove('hidden');
            document.getElementById('qrModal').classList.add('flex');
        }

        function closeQrModal() {
            document.getElementById('qrModal').classList.add('hidden');
            document.getElementById('qrModal').classList.remove('flex');
        }

    </script>

</x-app-layout>
