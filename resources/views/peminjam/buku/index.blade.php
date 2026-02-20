<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

        <!-- Header -->
        <div class="bg-white p-6 rounded-xl shadow-sm border border-[#7AB2B2]/20">
            <h1 class="text-2xl font-bold text-[#09637E]">
                Katalog Buku
            </h1>
            <p class="text-sm text-gray-600 mt-1">
                Temukan dan pinjam buku favoritmu dengan mudah.
            </p>

            <!-- Search -->
            <form method="GET" class="mt-4 flex flex-col md:flex-row gap-3">

                <input type="text" name="search" value="{{ request('search') }}"
                    placeholder="Cari judul atau pengarang..."
                    class="flex-1 px-4 py-2 border rounded-lg focus:ring-2 focus:ring-[#09637E] focus:outline-none">

                <select name="status" class="px-4 py-2 border rounded-lg focus:ring-2 focus:ring-[#09637E]">
                    <option value="">Semua Status</option>
                    <option value="tersedia" {{ request('status')=='tersedia'?'selected':'' }}>
                        Tersedia
                    </option>
                    <option value="dipinjam" {{ request('status')=='dipinjam'?'selected':'' }}>
                        Dipinjam
                    </option>
                </select>

                <select name="sort" class="px-4 py-2 border rounded-lg focus:ring-2 focus:ring-[#09637E]">
                    <option value="">Terbaru</option>
                    <option value="az" {{ request('sort')=='az'?'selected':'' }}>A-Z</option>
                    <option value="za" {{ request('sort')=='za'?'selected':'' }}>Z-A</option>
                </select>

                <button type="submit"
                    class="bg-[#09637E] text-white px-6 py-2 rounded-lg hover:bg-[#088395] transition">
                    Cari
                </button>

            </form>
        </div>

        @if($dataBuku->count() > 0)

        <!-- Grid Buku -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

            @foreach ($dataBuku as $buku)
            <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition overflow-hidden relative">

                <!-- Cover -->
                <div class="relative">
                    <img src="{{ $buku->cover ? asset('storage/'.$buku->cover) : asset('images/default-book.png') }}"
                        class="h-60 w-full object-cover">

                    <!-- Favorit Icon -->
                    <form method="POST" action="{{ route('peminjam.buku.favorit', $buku->id) }}"
                        class="absolute top-3 right-3">
                        @csrf
                        <button type="submit" class="bg-white p-2 rounded-full shadow hover:scale-110 transition">

                            @if(in_array($buku->id, $favoritIds))
                            <svg class="w-5 h-5 text-red-500 fill-current" viewBox="0 0 20 20">
                                <path
                                    d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" />
                            </svg>
                            @else
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4.318 6.318a4 4 0 015.656 0L12 8.344l2.026-2.026a4 4 0 115.656 5.656L12 19.656 4.318 11.974a4 4 0 010-5.656z" />
                            </svg>
                            @endif

                        </button>
                    </form>
                </div>

                <!-- Content -->
                <div class="p-4 space-y-2">

                    <h2 class="font-semibold text-gray-800 line-clamp-2">
                        {{ $buku->judul_buku }}
                    </h2>

                    <p class="text-sm text-gray-500">
                        {{ $buku->pengarang }}
                    </p>

                    @if($buku->jumlah_buku > 0)
                    <span class="text-xs px-3 py-1 rounded-full bg-[#7AB2B2]/20 text-[#09637E] font-medium">
                        Tersedia
                    </span>
                    @else
                    <span class="text-xs px-3 py-1 rounded-full bg-red-100 text-red-600 font-medium">
                        Buku Sedang Habis
                    </span>
                    @endif

                    @if($buku->jumlah_buku > 0)
                    <a href="{{ route('peminjam.buku.detail', $buku->id) }}"
                        class="block mt-3 text-center bg-[#09637E] text-white py-2 rounded-lg hover:bg-[#088395] transition text-sm font-medium">
                        Lihat Detail
                    </a>
                    @else
                    <button disabled
                        class="block mt-3 text-center bg-gray-200 text-gray-400 py-2 rounded-lg text-sm font-medium cursor-not-allowed">
                        Buku Habis
                    </button>
                    @endif
                </div>
            </div>
            @endforeach

        </div>

        @else
        <div class="bg-white rounded-2xl shadow-sm border border-[#7AB2B2]/20 p-12 text-center">

          {{--  <div class="flex justify-center mb-4">
                <div class="bg-[#EBF4F6] p-6 rounded-full">
                    📚
                </div>
            </div> --}}

            <h2 class="text-xl font-semibold text-[#09637E]">
                Tidak Ada Buku Ditemukan
            </h2>

           {{-- <a href="{{ route('peminjam.buku.index') }}"
                class="inline-block mt-6 bg-[#09637E] text-white px-6 py-2 rounded-lg hover:bg-[#088395] transition">
                Reset Filter
            </a> --}}

        </div>

        @endif

        <!-- Pagination -->
        <div>
            {{ $dataBuku->links() }}
        </div>

    </div>
</x-app-layout>
