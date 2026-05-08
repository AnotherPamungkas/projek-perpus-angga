<x-app-layout>

    <div class="min-h-screen bg-[#F4F4F2]">

        <div class="max-w-6xl mx-auto px-6 py-8 space-y-8">

            {{-- HEADER --}}
            <div class="bg-white rounded-3xl shadow-sm border border-[#BBBFCA] overflow-hidden">

                <div class="px-8 py-6 bg-[#3D3D3B]">

                    <h1 class="text-xl font-bold text-white">
                        Riwayat Peminjaman
                    </h1>

                    <p class="text-sm text-white/70 mt-1">
                        Pantau seluruh aktivitas peminjaman buku kamu dengan lebih mudah.
                    </p>

                </div>

            </div>

            {{-- STATISTIK --}}
            <div class="grid grid-cols-2 md:grid-cols-4 gap-5">

                {{-- Total --}}
                <div
                    class="bg-white p-5 rounded-2xl border border-[#BBBFCA] border-t-4 border-t-[#3D3D3B] shadow-sm">

                    <p class="text-sm text-[#6B6B6B]">
                        Total
                    </p>

                    <h2 class="text-2xl font-bold text-[#3D3D3B] mt-2">
                        {{ $total }}
                    </h2>

                </div>

                {{-- Aktif --}}
                <div
                    class="bg-white p-5 rounded-2xl border border-[#BBBFCA] border-t-4 border-t-yellow-500 shadow-sm">

                    <p class="text-sm text-[#6B6B6B]">
                        Sedang Dipinjam
                    </p>

                    <h2 class="text-2xl font-bold text-yellow-600 mt-2">
                        {{ $aktif }}
                    </h2>

                </div>

                {{-- Selesai --}}
                <div
                    class="bg-white p-5 rounded-2xl border border-[#BBBFCA] border-t-4 border-t-green-500 shadow-sm">

                    <p class="text-sm text-[#6B6B6B]">
                        Selesai
                    </p>

                    <h2 class="text-2xl font-bold text-green-600 mt-2">
                        {{ $selesai }}
                    </h2>

                </div>

                {{-- Terlambat --}}
                <div
                    class="bg-white p-5 rounded-2xl border border-[#BBBFCA] border-t-4 border-t-red-500 shadow-sm">

                    <p class="text-sm text-[#6B6B6B]">
                        Terlambat
                    </p>

                    <h2 class="text-2xl font-bold text-red-500 mt-2">
                        {{ $terlambat }}
                    </h2>

                </div>

            </div>

            {{-- FILTER --}}
            <div class="bg-white rounded-3xl shadow-sm border border-[#BBBFCA] p-6">

                <form method="GET"
                    class="grid grid-cols-1 md:grid-cols-4 gap-4">

                    {{-- Search --}}
                    <div class="md:col-span-2">

                        <label class="block text-xs font-semibold text-[#6B6B6B] mb-2">
                            Cari Buku
                        </label>

                        <input type="text"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Cari judul buku..."
                            class="w-full border border-[#BBBFCA] rounded-2xl px-4 py-3 text-sm bg-[#F4F4F2] focus:ring-2 focus:ring-[#6B6B6B] focus:outline-none focus:bg-white transition">

                    </div>

                    {{-- Status --}}
                    <div>

                        <label class="block text-xs font-semibold text-[#6B6B6B] mb-2">
                            Status
                        </label>

                        <select name="status"
                            class="w-full border border-[#BBBFCA] rounded-2xl px-4 py-3 text-sm bg-[#F4F4F2] focus:ring-2 focus:ring-[#6B6B6B] focus:outline-none">

                            <option value="">Semua</option>

                            <option value="menunggu_validasi"
                                {{ request('status')=='menunggu_validasi' ? 'selected' : '' }}>
                                Menunggu Validasi
                            </option>

                            <option value="dipinjam"
                                {{ request('status')=='dipinjam' ? 'selected' : '' }}>
                                Dipinjam
                            </option>

                            <option value="dikembalikan"
                                {{ request('status')=='dikembalikan' ? 'selected' : '' }}>
                                Dikembalikan
                            </option>

                        </select>

                    </div>

                    {{-- Sort --}}
                    <div>

                        <label class="block text-xs font-semibold text-[#6B6B6B] mb-2">
                            Urutkan
                        </label>

                        <select name="sort"
                            class="w-full border border-[#BBBFCA] rounded-2xl px-4 py-3 text-sm bg-[#F4F4F2] focus:ring-2 focus:ring-[#6B6B6B] focus:outline-none">

                            <option value="baru">
                                Terbaru
                            </option>

                            <option value="lama"
                                {{ request('sort')=='lama' ? 'selected' : '' }}>
                                Terlama
                            </option>

                        </select>

                    </div>

                    {{-- Button --}}
                    <div class="md:col-span-4 flex justify-end">

                        <button type="submit"
                            class="px-6 py-3 rounded-2xl bg-[#3D3D3B] text-white text-sm font-semibold hover:bg-[#2E2E2D] transition-all duration-300 shadow-sm">

                            Terapkan Filter

                        </button>

                    </div>

                </form>

            </div>

            {{-- LIST RIWAYAT --}}
            <div class="grid md:grid-cols-2 gap-5">

                @forelse($riwayat as $item)

                    <div
                        class="bg-white rounded-3xl border border-[#BBBFCA] shadow-sm hover:shadow-md transition-all duration-300 overflow-hidden">

                        <div class="p-5">

                            <div class="flex gap-4">

                                {{-- Cover --}}
                                <img src="{{ $item->buku->cover
                                    ? asset('storage/cover-buku/'.$item->buku->cover)
                                    : asset('images/default-book.png') }}"
                                    class="w-24 h-32 object-cover rounded-2xl border border-[#BBBFCA] shadow-sm flex-shrink-0">

                                {{-- Info --}}
                                <div class="flex-1 min-w-0">

                                    {{-- Title --}}
                                    <h3 class="font-bold text-[#3D3D3B] text-sm leading-snug line-clamp-2">
                                        {{ $item->buku->judul_buku }}
                                    </h3>

                                    {{-- Dates --}}
                                    <div class="mt-3 space-y-2">

                                        <p class="text-xs text-[#6B6B6B]">
                                            Tanggal Pinjam:
                                            <span class="font-medium text-[#3D3D3B]">
                                                {{ \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d M Y') }}
                                            </span>
                                        </p>

                                        <p class="text-xs text-[#6B6B6B]">
                                            Jatuh Tempo:
                                            <span class="font-medium text-[#3D3D3B]">
                                                {{ \Carbon\Carbon::parse($item->tanggal_jatuh_tempo)->format('d M Y') }}
                                            </span>
                                        </p>

                                    </div>

                                    {{-- Status --}}
                                    <div class="mt-4">

                                        @if($item->status === 'dikembalikan')
                                            <span
                                                class="px-3 py-1 text-xs bg-green-100 text-green-700 rounded-full font-semibold">
                                                ● Dikembalikan
                                            </span>

                                        @elseif($item->status === 'terlambat')
                                            <span
                                                class="px-3 py-1 text-xs bg-red-100 text-red-600 rounded-full font-semibold">
                                                ● Terlambat
                                            </span>

                                        @elseif($item->status === 'menunggu_validasi')
                                            <span
                                                class="px-3 py-1 text-xs bg-yellow-100 text-yellow-700 rounded-full font-semibold">
                                                ● Menunggu Validasi
                                            </span>

                                        @elseif($item->status === 'dipinjam')
                                            <span
                                                class="px-3 py-1 text-xs bg-[#E8E8E8] text-[#3D3D3B] rounded-full font-semibold">
                                                ● Sedang Dipinjam
                                            </span>

                                        @else
                                            <span
                                                class="px-3 py-1 text-xs bg-gray-200 text-gray-600 rounded-full font-semibold">
                                                ● Ditolak
                                            </span>
                                        @endif

                                    </div>

                                    {{-- Action --}}
                                    <a href="{{ route('peminjam.riwayat-peminjaman.detail', $item->id) }}"
                                        class="inline-flex items-center gap-2 mt-4 text-sm font-semibold text-[#3D3D3B] hover:text-[#6B6B6B] transition">

                                        Lihat Detail

                                        <svg class="w-4 h-4"
                                            fill="none"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24">

                                            <path stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M9 5l7 7-7 7" />

                                        </svg>

                                    </a>

                                </div>

                            </div>

                        </div>

                    </div>

                @empty

                    <div
                        class="col-span-2 bg-white rounded-3xl border border-[#BBBFCA] shadow-sm p-12 text-center">

                        <div class="text-[#6B6B6B] text-sm">
                            Belum ada riwayat peminjaman.
                        </div>

                    </div>

                @endforelse

            </div>

            {{-- PAGINATION --}}
            <div class="pb-4">
                {{ $riwayat->links() }}
            </div>

        </div>

    </div>

</x-app-layout>
