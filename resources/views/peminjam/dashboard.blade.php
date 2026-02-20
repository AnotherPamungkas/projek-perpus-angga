<x-app-layout>
    <x-slot name="header">
        Dashboard MyLibrary
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

        <!-- Welcome -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-[#7AB2B2]/20">
            <h3 class="text-lg font-semibold text-[#09637E]">
                Halo, {{ Auth::user()->nama }} 👋
            </h3>
            <p class="text-sm text-gray-600 mt-1">
                Berikut ringkasan aktivitas peminjaman kamu hari ini.
            </p>
        </div>

        <!-- Statistik -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">

            <div class="bg-white p-6 rounded-xl shadow-sm border-t-4 border-[#09637E]">
                <p class="text-sm text-gray-500">Buku Aktif</p>
                <p class="text-3xl font-bold text-[#09637E] mt-2">
                    {{ $bukuAktif }}
                </p>

            </div>

            <div class="bg-white p-6 rounded-xl shadow-sm border-t-4 border-[#088395]">
                <p class="text-sm text-gray-500">Hampir Jatuh Tempo</p>
                <p class="text-3xl font-bold text-[#088395] mt-2">
                    {{ $hampirJatuhTempo }}
                </p>

            </div>

            <div class="bg-white p-6 rounded-xl shadow-sm border-t-4 border-[#7AB2B2]">
                <p class="text-sm text-gray-500">Total Riwayat</p>
                <p class="text-3xl font-bold text-[#09637E] mt-2">
                    {{ $totalRiwayat }}
                </p>

            </div>

            <div class="bg-white p-6 rounded-xl shadow-sm border-t-4 border-red-500">
                <p class="text-sm text-gray-500">Total Denda</p>
                <p class="text-3xl font-bold text-red-500 mt-2">
                    Rp {{ number_format($totalDenda, 0, ',', '.') }}
                </p>

                @if($totalDenda > 0)
                <p class="text-xs text-red-500 mt-1">
                    {{ $dendaBelumBayar->count() }} buku memiliki denda
                </p>
                @endif
            </div>

        </div>

        <!-- Alert -->
        @if($peringatanJatuhTempo->count())
        <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 rounded-lg">
            <p class="text-sm font-semibold text-yellow-700 mb-2">
                ⚠️ Peringatan Jatuh Tempo
            </p>

            <ul class="text-sm text-yellow-700 space-y-1">
                @foreach($peringatanJatuhTempo as $item)
                <li>
                    {{ $item->buku->judul_buku }} -
                    jatuh tempo
                    {{ \Carbon\Carbon::parse($item->tanggal_jatuh_tempo)->format('d M Y') }}
                </li>
                @endforeach
            </ul>
        </div>
        @endif

        @if($terlambat > 0)
        <div class="bg-red-50 border-l-4 border-red-400 p-4 rounded-lg">
            <p class="text-sm font-semibold text-red-700">
                ⚠️ Kamu memiliki {{ $terlambat }} buku terlambat.
            </p>
        </div>
        @endif


        <!-- Buku Aktif -->
        <div class="bg-white rounded-xl shadow-sm p-6">
            <h3 class="font-semibold text-lg text-[#09637E] mb-4">
                Buku Sedang Dipinjam
            </h3>

            <div class="space-y-4">

                @forelse($bukuDipinjam as $pinjam)
                <div class="flex items-center justify-between border rounded-lg p-4 hover:shadow-md transition">
                    <div>
                        <p class="font-semibold">
                            {{ $pinjam->buku->judul_buku }}
                        </p>
                        <p class="text-sm text-gray-500">
                            Jatuh tempo:
                            {{ \Carbon\Carbon::parse($pinjam->tanggal_jatuh_tempo)->format('d M Y') }}
                        </p>
                    </div>

                    @php
                    $hariIni = \Carbon\Carbon::now()->startOfDay();
                    $jatuhTempo = \Carbon\Carbon::parse($pinjam->tanggal_jatuh_tempo)->startOfDay();
                    $sisaHari = $hariIni->diffInDays($jatuhTempo, false);
                    @endphp

                    @if($sisaHari < 0) <span class="px-3 py-1 text-xs rounded-full bg-red-100 text-red-700 font-medium">
                        Terlambat {{ abs($sisaHari) }} Hari
                        </span>

                        @elseif($sisaHari <= 1) <span
                            class="px-3 py-1 text-xs rounded-full bg-yellow-100 text-yellow-700 font-medium">
                            {{ $sisaHari }} Hari Lagi
                            </span>

                            @else
                            <span class="px-3 py-1 text-xs rounded-full bg-[#7AB2B2]/20 text-[#09637E] font-medium">
                                Aman
                            </span>
                    @endif
                </div>
                @empty
                <p class="text-sm text-gray-500">
                    Tidak ada buku sedang dipinjam.
                </p>
                @endforelse


            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm p-6">
            <h3 class="font-semibold text-lg text-[#09637E] mb-4">
                Buku Favorit Saya
            </h3>

            @if($bukuFavorit->count())
            <div class="flex gap-4 overflow-x-auto pb-2">

                @foreach($bukuFavorit as $buku)
                <a href="{{ route('peminjam.buku.detail', $buku->id) }}"
                    class="min-w-[150px] bg-gray-50 rounded-lg shadow-sm hover:shadow-md transition">

                    <img src="{{ $buku->cover
                ? asset('storage/'.$buku->cover)
                : asset('images/default-book.png') }}" class="h-40 w-full object-cover rounded-t-lg">

                    <div class="p-3">
                        <p class="text-sm font-semibold line-clamp-2">
                            {{ $buku->judul_buku }}
                        </p>
                    </div>

                </a>
                @endforeach

            </div>
            @else
            <p class="text-sm text-gray-500">
                Belum ada buku favorit.
            </p>
            @endif
        </div>

        {{--  <div class="bg-white rounded-xl shadow-sm p-6">
            <h3 class="font-semibold text-lg text-[#09637E] mb-4">
                Buku Terbaru
            </h3>

            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">

                @foreach($bukuTerbaru as $buku)
                <a href="{{ route('peminjam.buku.detail', $buku->id) }}"
        class="bg-gray-50 rounded-lg shadow-sm hover:shadow-md transition">

        <img src="{{ $buku->cover
                ? asset('storage/cover-buku/'.$buku->cover)
                : asset('images/default-book.png') }}" class="h-32 w-full object-cover rounded-t-lg">

        <div class="p-2">
            <p class="text-xs font-semibold line-clamp-2">
                {{ $buku->judul_buku }}
            </p>
        </div>

        </a>
        @endforeach

    </div>
    </div>
    --}}


    <!-- Quick Actions -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        <a href="{{ route('peminjam.buku.index') }}"
            class="bg-[#09637E] text-white p-4 rounded-xl text-center font-medium hover:bg-[#088395] transition shadow-sm">
            Cari Buku
        </a>

        <a href="{{ route('peminjam.riwayat-peminjaman.index') }}"
            class="bg-white border border-[#09637E] text-[#09637E] p-4 rounded-xl text-center font-medium hover:bg-[#EBF4F6] transition shadow-sm">
            Lihat Riwayat
        </a>

        <button onclick="openDendaModal()"
            class="bg-white border border-red-400 text-red-500 p-4 rounded-xl text-center font-medium hover:bg-red-50 transition shadow-sm w-full">
            Lihat Denda
        </button>

    </div>

    <div class="bg-white rounded-xl shadow-sm p-6">
        <p class="text-sm text-gray-600">
            📚 {{ $bukuAktif }} dari {{ $maksimalPinjam }} buku sedang dipinjam.
        </p>

        <div class="w-full bg-gray-200 rounded-full h-3 mt-3">
            <div class="bg-[#09637E] h-3 rounded-full transition-all duration-500"
                style="width: {{ $persentaseKuota }}%">
            </div>
        </div>
    </div>


    </div>

    <div id="dendaModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">

        <div class="bg-white w-full max-w-lg rounded-2xl shadow-xl p-6">

            <h2 class="text-lg font-bold mb-4 text-red-600">
                Detail Denda
            </h2>

            @if($dendaBelumBayar->count())
            <div class="space-y-4 max-h-64 overflow-y-auto">
                @foreach($dendaBelumBayar as $item)
                <div class="border rounded-lg p-3">
                    <p class="font-semibold">
                        {{ $item->buku->judul_buku }}
                    </p>

                    <p class="text-sm text-gray-500">
                        Jatuh Tempo:
                        {{ $item->tanggal_jatuh_tempo->format('d M Y') }}
                    </p>

                    <p class="text-sm text-red-600 font-semibold mt-1">
                        Denda:
                        Rp {{ number_format($item->denda, 0, ',', '.') }}
                    </p>

                    <p class="text-xs text-gray-500">
                        Status: {{ ucwords(str_replace('_', ' ', $item->status_pembayaran)) }}
                    </p>
                </div>
                @endforeach
            </div>

            <div class="mt-4 border-t pt-3 text-right">
                <p class="font-bold text-red-600">
                    Total: Rp {{ number_format($totalDenda, 0, ',', '.') }}
                </p>
            </div>
            @else
            <p class="text-sm text-gray-500">
                Tidak ada denda aktif.
            </p>
            @endif

            <div class="flex justify-end mt-4">
                <button onclick="closeDendaModal()" class="px-4 py-2 bg-gray-300 rounded-lg">
                    Tutup
                </button>
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
