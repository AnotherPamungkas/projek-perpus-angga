<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold text-[#3D3D3B]">
            Validasi Peminjaman
        </h2>
    </x-slot>

    <div class="min-h-screen bg-[#F4F4F2] py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Alert Success --}}
            @if(session('success'))
                <div class="mb-6 bg-[#3D3D3B] text-white px-5 py-4 rounded-2xl shadow-sm">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Alert Error --}}
            @if(session('error'))
                <div class="mb-6 bg-red-50 text-red-600 border border-red-200 px-5 py-4 rounded-2xl shadow-sm">
                    {{ session('error') }}
                </div>
            @endif

            {{-- Summary Section --}}
            <div class="mb-8 grid grid-cols-1 md:grid-cols-2 gap-5">

                {{-- Total Menunggu --}}
                <div
                    class="bg-[#E8E8E8] rounded-2xl border border-[#BBBFCA]
                    border-t-4 border-t-[#3D3D3B] p-5 shadow-sm">

                    <p class="text-sm text-[#3D3D3B]/70 font-medium">
                        Menunggu Validasi
                    </p>

                    <h3 class="text-3xl font-bold text-[#3D3D3B] mt-2">
                        {{ $totalMenunggu }}
                    </h3>
                </div>

                {{-- Total Data --}}
                <div
                    class="bg-[#E8E8E8] rounded-2xl border border-[#BBBFCA]
                    border-t-4 border-t-[#BBBFCA] p-5 shadow-sm">

                    <p class="text-sm text-[#3D3D3B]/70 font-medium">
                        Total Permintaan
                    </p>

                    <h3 class="text-3xl font-bold text-[#3D3D3B] mt-2">
                        {{ $peminjaman->total() }}
                    </h3>
                </div>

            </div>

            {{-- Header Section --}}
            <div class="mb-6 flex flex-col md:flex-row md:items-center md:justify-between gap-4">

                <div>
                    <h3 class="text-lg font-bold text-[#3D3D3B]">
                        Daftar Validasi Peminjaman
                    </h3>

                    <p class="text-sm text-[#3D3D3B]/60 mt-1">
                        Kelola dan validasi permintaan peminjaman buku dari peminjam.
                    </p>
                </div>

            </div>

            {{-- Card Grid --}}
            @if($peminjaman->count())
                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">

                    @foreach($peminjaman as $item)

                        <div
                            class="bg-[#E8E8E8] rounded-2xl border border-[#BBBFCA]
                            shadow-sm overflow-hidden hover:shadow-md
                            transition-all duration-300">

                            {{-- Cover --}}
                            <div class="relative">
                                <img
                                    src="{{ $item->buku->cover
                                        ? asset('storage/cover-buku/'.$item->buku->cover)
                                        : asset('images/default-book.png') }}"
                                    class="w-full h-52 object-cover">

                                <div class="absolute top-3 right-3">
                                    <span
                                        class="px-3 py-1 rounded-full text-xs font-semibold
                                        bg-white/90 text-[#3D3D3B] shadow-sm">
                                        Pending
                                    </span>
                                </div>
                            </div>

                            {{-- Content --}}
                            <div class="p-5">

                                {{-- Judul --}}
                                <h3 class="font-bold text-[#3D3D3B] text-lg line-clamp-2">
                                    {{ $item->buku->judul_buku }}
                                </h3>

                                {{-- Kategori --}}
                                <p class="text-sm text-[#3D3D3B]/60 mt-1">
                                    {{ $item->buku->kategori->nama_kategori }}
                                </p>

                                {{-- Divider --}}
                                <div class="border-t border-[#BBBFCA] my-4"></div>

                                {{-- Detail --}}
                                <div class="space-y-3 text-sm">

                                    <div class="flex justify-between">
                                        <span class="text-[#3D3D3B]/60">
                                            Peminjam
                                        </span>

                                        <span class="font-medium text-[#3D3D3B]">
                                            {{ $item->peminjam->nama }}
                                        </span>
                                    </div>

                                    <div class="flex justify-between">
                                        <span class="text-[#3D3D3B]/60">
                                            Jumlah
                                        </span>

                                        <span class="font-medium text-[#3D3D3B]">
                                            {{ $item->jumlah_dipinjam }}
                                        </span>
                                    </div>

                                    <div class="flex justify-between">
                                        <span class="text-[#3D3D3B]/60">
                                            Tanggal Pinjam
                                        </span>

                                        <span class="font-medium text-[#3D3D3B]">
                                            {{ \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d M Y') }}
                                        </span>
                                    </div>

                                    <div class="flex justify-between">
                                        <span class="text-[#3D3D3B]/60">
                                            Jatuh Tempo
                                        </span>

                                        <span class="font-medium text-[#3D3D3B]">
                                            {{ \Carbon\Carbon::parse($item->tanggal_jatuh_tempo)->format('d M Y') }}
                                        </span>
                                    </div>

                                    <div class="flex justify-between">
                                        <span class="text-[#3D3D3B]/60">
                                            Stok Tersedia
                                        </span>

                                        <span class="font-medium text-[#3D3D3B]">
                                            {{ $item->buku->jumlah_buku }}
                                        </span>
                                    </div>

                                </div>

                                {{-- Alert Stok --}}
                                @if($item->buku->jumlah_buku < $item->jumlah_dipinjam)
                                    <div
                                        class="mt-4 bg-red-50 border border-red-200
                                        text-red-600 text-sm px-4 py-3 rounded-xl">

                                        Stok buku tidak mencukupi untuk permintaan ini.
                                    </div>
                                @endif

                                {{-- Button --}}
                                <div class="mt-5">
                                    <a href="{{ route('petugas.validasi-peminjaman.detail', $item->id) }}"
                                        class="w-full flex items-center justify-center
                                        py-3 rounded-xl bg-[#3D3D3B]
                                        text-white font-semibold shadow-sm
                                        hover:bg-[#1F1F1E]
                                        active:scale-[0.98]
                                        transition-all duration-300">

                                        Lihat Detail
                                    </a>
                                </div>

                            </div>

                        </div>

                    @endforeach

                </div>
            @else
                {{-- Empty State --}}
                <div
                    class="bg-[#E8E8E8] border border-[#BBBFCA]
                    rounded-2xl p-10 text-center shadow-sm">

                    <p class="text-[#3D3D3B]/60 text-sm">
                        Tidak ada data peminjaman yang menunggu validasi.
                    </p>
                </div>
            @endif

            {{-- Pagination --}}
            <div class="mt-8">
                {{ $peminjaman->links() }}
            </div>

        </div>
    </div>
</x-app-layout>
