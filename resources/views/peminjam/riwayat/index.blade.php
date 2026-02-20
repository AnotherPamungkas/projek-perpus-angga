<x-app-layout>

<div class="max-w-6xl mx-auto px-6 py-10">

    {{-- Judul --}}
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-[#09637E]">
            Riwayat Peminjaman
        </h1>
        <p class="text-gray-500 text-sm mt-1">
            Lihat dan kelola riwayat peminjaman buku kamu
        </p>
    </div>

    {{-- STATISTIK --}}
    <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-10">

        <div class="bg-white p-5 rounded-xl shadow">
            <p class="text-gray-500 text-sm">Total</p>
            <h2 class="text-2xl font-bold text-[#09637E]">{{ $total }}</h2>
        </div>

        <div class="bg-white p-5 rounded-xl shadow">
            <p class="text-gray-500 text-sm">Sedang Dipinjam</p>
            <h2 class="text-2xl font-bold text-blue-600">{{ $aktif }}</h2>
        </div>

        <div class="bg-white p-5 rounded-xl shadow">
            <p class="text-gray-500 text-sm">Selesai</p>
            <h2 class="text-2xl font-bold text-green-600">{{ $selesai }}</h2>
        </div>

        <div class="bg-white p-5 rounded-xl shadow">
            <p class="text-gray-500 text-sm">Terlambat</p>
            <h2 class="text-2xl font-bold text-red-600">{{ $terlambat }}</h2>
        </div>

    </div>

    {{-- FILTER --}}
    <div class="bg-white p-6 rounded-2xl shadow mb-10">
        <form method="GET" class="flex flex-wrap gap-4 items-end">

            <div>
                <label class="text-sm text-gray-600">Cari Buku</label>
                <input type="text" name="search"
                       value="{{ request('search') }}"
                       placeholder="Judul buku..."
                       class="mt-1 border rounded-xl px-4 py-2 w-56 focus:ring-2 focus:ring-[#09637E] focus:outline-none">
            </div>

            <div>
                <label class="text-sm text-gray-600">Status</label>
                <select name="status"
                        class="mt-1 border rounded-xl px-4 py-2 focus:ring-2 focus:ring-[#09637E] focus:outline-none">
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
                <label class="text-sm text-gray-600">Urutkan</label>
                <select name="sort"
                        class="mt-1 border rounded-xl px-4 py-2 focus:ring-2 focus:ring-[#09637E] focus:outline-none">
                    <option value="baru">Terbaru</option>
                    <option value="lama" {{ request('sort')=='lama' ? 'selected' : '' }}>
                        Terlama
                    </option>
                </select>
            </div>

            <button class="bg-[#09637E] text-white px-6 py-2 rounded-xl hover:bg-[#088395] transition">
                Terapkan
            </button>

        </form>
    </div>

    {{-- LIST RIWAYAT --}}
    <div class="grid md:grid-cols-2 gap-6">

        @forelse($riwayat as $item)

            <div class="bg-white rounded-2xl shadow hover:shadow-lg transition p-6">

                <div class="flex gap-4">

                    {{-- Cover --}}
                    <img src="{{ $item->buku->cover
                        ? asset('storage/'.$item->buku->cover)
                        : asset('images/default-book.png') }}"
                        class="w-20 h-28 object-cover rounded-lg">

                    {{-- Info --}}
                    <div class="flex-1">

                        <h3 class="font-semibold text-[#09637E]">
                            {{ $item->buku->judul_buku }}
                        </h3>

                        <p class="text-sm text-gray-500 mt-1">
                            Pinjam: {{ \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d M Y') }}
                        </p>

                        <p class="text-sm text-gray-500">
                            Jatuh Tempo: {{ \Carbon\Carbon::parse($item->tanggal_jatuh_tempo)->format('d M Y') }}
                        </p>

                        {{-- STATUS --}}
                        <div class="mt-3">

                            @if($item->status === 'dikembalikan')
                                <span class="px-3 py-1 text-xs bg-green-100 text-green-700 rounded-full">
                                    Dikembalikan
                                </span>
                            @elseif($item->status === 'terlambat')
                                <span class="px-3 py-1 text-xs bg-red-100 text-red-600 rounded-full">
                                    Terlambat
                                </span>
                            @elseif($item->status === 'menunggu_validasi')
                                <span class="px-3 py-1 text-xs bg-yellow-100 text-yellow-600 rounded-full">
                                    Menunggu Validasi
                                </span>
                            @elseif($item->status === 'dipinjam')
                                <span class="px-3 py-1 text-xs bg-blue-100 text-blue-600 rounded-full">
                                    Sedang Dipinjam
                                </span>
                            @else
                                <span class="px-3 py-1 text-xs bg-red-100 text-red-600 rounded-full">
                                    Ditolak
                                </span>
                            @endif

                        </div>

                        <a href="{{ route('peminjam.riwayat-peminjaman.detail', $item->id) }}"
                           class="inline-block mt-4 text-sm font-medium text-[#09637E] hover:underline">
                            Lihat Detail →
                        </a>

                    </div>

                </div>

            </div>

        @empty
            <div class="col-span-2 text-center text-gray-500 py-10">
                Belum ada riwayat peminjaman.
            </div>
        @endforelse

    </div>

    {{-- PAGINATION --}}
    <div class="mt-10">
        {{ $riwayat->links() }}
    </div>

</div>

</x-app-layout>
