<x-app-layout>

<div class="max-w-6xl mx-auto px-6 py-8 space-y-6" style="background-color: #f0f4f8;">

    {{-- Judul --}}
    <div class="bg-white rounded-2xl shadow-sm overflow-hidden">
        <div class="px-8 py-5 flex items-center justify-between"
            style="background: linear-gradient(135deg, #1557b0 0%, #1a73e8 55%, #4da3ff 100%);">
            <div>
                <h1 class="text-lg font-bold text-white">Riwayat Peminjaman</h1>
                <p class="text-white/70 text-xs mt-0.5">Lihat dan kelola riwayat peminjaman buku kamu</p>
            </div>
        </div>
    </div>

    {{-- STATISTIK --}}
    <div class="grid grid-cols-2 md:grid-cols-4 gap-5">

        <div class="bg-white p-5 rounded-2xl shadow-sm border-t-4 border-[#1a73e8]">
            <p class="text-gray-500 text-sm">Total</p>
            <h2 class="text-2xl font-bold text-[#1a73e8] mt-1">{{ $total }}</h2>
        </div>

        <div class="bg-white p-5 rounded-2xl shadow-sm border-t-4 border-[#4da3ff]">
            <p class="text-gray-500 text-sm">Sedang Dipinjam</p>
            <h2 class="text-2xl font-bold text-[#1a73e8] mt-1">{{ $aktif }}</h2>
        </div>

        <div class="bg-white p-5 rounded-2xl shadow-sm border-t-4 border-green-400">
            <p class="text-gray-500 text-sm">Selesai</p>
            <h2 class="text-2xl font-bold text-green-600 mt-1">{{ $selesai }}</h2>
        </div>

        <div class="bg-white p-5 rounded-2xl shadow-sm border-t-4 border-red-400">
            <p class="text-gray-500 text-sm">Terlambat</p>
            <h2 class="text-2xl font-bold text-red-500 mt-1">{{ $terlambat }}</h2>
        </div>

    </div>

    {{-- FILTER --}}
    <div class="bg-white p-6 rounded-2xl shadow-sm">
        <form method="GET" class="flex flex-wrap gap-4 items-end">

            <div>
                <label class="text-xs font-semibold text-gray-500">Cari Buku</label>
                <input type="text" name="search"
                    value="{{ request('search') }}"
                    placeholder="Judul buku..."
                    class="mt-1 border border-gray-200 rounded-xl px-4 py-2 w-56 text-sm bg-gray-50 focus:ring-2 focus:ring-[#1a73e8] focus:outline-none focus:bg-white transition">
            </div>

            <div>
                <label class="text-xs font-semibold text-gray-500">Status</label>
                <select name="status"
                    class="mt-1 border border-gray-200 rounded-xl px-4 py-2 text-sm bg-gray-50 focus:ring-2 focus:ring-[#1a73e8] focus:outline-none focus:bg-white transition">
                    <option value="">Semua</option>
                    <option value="menunggu_validasi" {{ request('status')=='menunggu_validasi' ? 'selected' : '' }}>
                        Menunggu Validasi
                    </option>
                    <option value="dipinjam" {{ request('status')=='dipinjam' ? 'selected' : '' }}>
                        Dipinjam
                    </option>
                    <option value="dikembalikan" {{ request('status')=='dikembalikan' ? 'selected' : '' }}>
                        Dikembalikan
                    </option>
                </select>
            </div>

            <div>
                <label class="text-xs font-semibold text-gray-500">Urutkan</label>
                <select name="sort"
                    class="mt-1 border border-gray-200 rounded-xl px-4 py-2 text-sm bg-gray-50 focus:ring-2 focus:ring-[#1a73e8] focus:outline-none focus:bg-white transition">
                    <option value="baru">Terbaru</option>
                    <option value="lama" {{ request('sort')=='lama' ? 'selected' : '' }}>Terlama</option>
                </select>
            </div>

            <button type="submit"
                class="px-6 py-2 rounded-xl text-sm font-semibold text-white shadow-sm transition hover:opacity-90"
                style="background: linear-gradient(135deg, #1557b0 0%, #1a73e8 55%, #4da3ff 100%);">
                Terapkan
            </button>

        </form>
    </div>

    {{-- LIST RIWAYAT --}}
    <div class="grid md:grid-cols-2 gap-5">

        @forelse($riwayat as $item)
        <div class="bg-white rounded-2xl shadow-sm hover:shadow-md transition p-5">

            <div class="flex gap-4">

                {{-- Cover --}}
                <img src="{{ $item->buku->cover
                    ? asset('storage/cover-buku/'.$item->buku->cover)
                    : asset('images/default-book.png') }}"
                    class="w-20 h-28 object-cover rounded-xl shadow-sm flex-shrink-0">

                {{-- Info --}}
                <div class="flex-1 min-w-0">

                    <h3 class="font-bold text-gray-800 text-sm leading-snug line-clamp-2">
                        {{ $item->buku->judul_buku }}
                    </h3>

                    <div class="mt-2 space-y-0.5">
                        <p class="text-xs text-gray-400 flex items-center gap-1">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            Pinjam: {{ \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d M Y') }}
                        </p>
                        <p class="text-xs text-gray-400 flex items-center gap-1">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Jatuh Tempo: {{ \Carbon\Carbon::parse($item->tanggal_jatuh_tempo)->format('d M Y') }}
                        </p>
                    </div>

                    {{-- STATUS --}}
                    <div class="mt-3">
                        @if($item->status === 'dikembalikan')
                        <span class="px-3 py-1 text-xs bg-green-100 text-green-700 rounded-full font-semibold">
                            ● Dikembalikan
                        </span>
                        @elseif($item->status === 'terlambat')
                        <span class="px-3 py-1 text-xs bg-red-100 text-red-600 rounded-full font-semibold">
                            ● Terlambat
                        </span>
                        @elseif($item->status === 'menunggu_validasi')
                        <span class="px-3 py-1 text-xs bg-yellow-100 text-yellow-600 rounded-full font-semibold">
                            ● Menunggu Validasi
                        </span>
                        @elseif($item->status === 'dipinjam')
                        <span class="px-3 py-1 text-xs bg-blue-50 text-[#1a73e8] rounded-full font-semibold">
                            ● Sedang Dipinjam
                        </span>
                        @else
                        <span class="px-3 py-1 text-xs bg-red-100 text-red-600 rounded-full font-semibold">
                            ● Ditolak
                        </span>
                        @endif
                    </div>

                    <a href="{{ route('peminjam.riwayat-peminjaman.detail', $item->id) }}"
                        class="inline-flex items-center gap-1 mt-3 text-xs font-semibold text-[#1a73e8] hover:underline">
                        Lihat Detail
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>

                </div>

            </div>

        </div>
        @empty
        <div class="col-span-2 bg-white rounded-2xl shadow-sm p-12 text-center">
            <p class="text-gray-400 text-sm">Belum ada riwayat peminjaman.</p>
        </div>
        @endforelse

    </div>

    {{-- PAGINATION --}}
    <div class="pb-4">
        {{ $riwayat->links() }}
    </div>

</div>

</x-app-layout>
