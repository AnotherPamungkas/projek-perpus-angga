<x-app-layout>
    <div class="min-h-screen" style="background-color: #f0f4f8;">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-8">

            <!-- Header -->
            <div class="bg-white p-6 rounded-2xl shadow-sm">
                <h1 class="text-2xl font-bold text-center text-[#1a73e8] tracking-wide">
                    Katalog Buku
                </h1>
                <p class="text-sm text-gray-400 text-center mt-1">
                    Temukan dan pinjam buku favoritmu dengan mudah.
                </p>
                <!-- Search -->
                <form method="GET" class="mt-5 flex flex-col md:flex-row gap-3">

                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Cari judul atau pengarang..."
                        class="flex-1 px-4 py-2 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-[#1a73e8] focus:outline-none bg-gray-50">

                    <select name="status"
                        class="px-4 py-2 border border-gray-200 rounded-xl text-sm bg-gray-50 focus:ring-2 focus:ring-[#1a73e8] focus:outline-none">
                        <option value="">Semua Status</option>
                        <option value="tersedia" {{ request('status')=='tersedia'?'selected':'' }}>Tersedia</option>
                        <option value="dipinjam" {{ request('status')=='dipinjam'?'selected':'' }}>Dipinjam</option>
                    </select>

                    <select name="sort"
                        class="px-4 py-2 border border-gray-200 rounded-xl text-sm bg-gray-50 focus:ring-2 focus:ring-[#1a73e8] focus:outline-none">
                        <option value="">Terbaru</option>
                        <option value="az" {{ request('sort')=='az'?'selected':'' }}>A-Z</option>
                        <option value="za" {{ request('sort')=='za'?'selected':'' }}>Z-A</option>
                    </select>

                    <button type="submit"
                        class="bg-[#1a73e8] text-white px-6 py-2 rounded-xl hover:bg-[#1557b0] transition text-sm font-semibold shadow-sm">
                        Cari
                    </button>

                </form>
            </div>

            @if($dataBuku->count() > 0)

            <!-- Grid Buku -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

                @foreach ($dataBuku as $buku)
                <div class="bg-white rounded-2xl shadow-sm hover:shadow-md transition-all duration-200 overflow-hidden flex flex-col">

                    <!-- Cover -->
                    <div class="relative">
                        <img src="{{ $buku->cover ? asset('storage/cover-buku/'.$buku->cover) : asset('images/default-book.png') }}"
                            class="h-56 w-full object-cover">

                        <!-- Favorit Icon -->
                        <form method="POST" action="{{ route('peminjam.buku.favorit', $buku->id) }}"
                            class="absolute top-3 right-3">
                            @csrf
                            <button type="submit"
                                class="bg-white p-1.5 rounded-full shadow hover:scale-110 transition">
                                @if(in_array($buku->id, $favoritIds))
                                <svg class="w-4 h-4 text-red-500 fill-current" viewBox="0 0 20 20">
                                    <path
                                        d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" />
                                </svg>
                                @else
                                <svg class="w-4 h-4 text-gray-300" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4.318 6.318a4 4 0 015.656 0L12 8.344l2.026-2.026a4 4 0 115.656 5.656L12 19.656 4.318 11.974a4 4 0 010-5.656z" />
                                </svg>
                                @endif
                            </button>
                        </form>

                        <!-- Status Badge -->
                        @if($buku->jumlah_buku > 0)
                        <span
                            class="absolute top-3 left-3 text-xs px-2 py-0.5 rounded-full bg-green-100 text-green-600 font-medium">
                            Tersedia
                        </span>
                        @else
                        <span
                            class="absolute top-3 left-3 text-xs px-2 py-0.5 rounded-full bg-red-100 text-red-500 font-medium">
                            Habis
                        </span>
                        @endif
                    </div>

                    <!-- Content -->
                    <div class="p-4 flex flex-col flex-1">

                        <h2 class="font-bold text-gray-800 text-sm line-clamp-2 leading-snug">
                            {{ $buku->judul_buku }}
                        </h2>

                        <p class="text-xs text-gray-400 mt-1 mb-3">
                            {{ $buku->pengarang }}
                        </p>

                        <div class="mt-auto space-y-2">
                            @if($buku->jumlah_buku > 0)
                            <a href="{{ route('peminjam.buku.detail', $buku->id) }}"
                                class="flex items-center justify-center gap-2 w-full bg-[#1a73e8] text-white py-2 rounded-xl hover:bg-[#1557b0] transition text-sm font-semibold shadow-sm">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                Detail
                            </a>
                            @else
                            <button disabled
                                class="flex items-center justify-center gap-2 w-full bg-gray-100 text-gray-400 py-2 rounded-xl text-sm font-semibold cursor-not-allowed">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                                </svg>
                                Buku Habis
                            </button>
                            @endif
                        </div>

                    </div>
                </div>
                @endforeach

            </div>

            @else
            <div class="bg-white rounded-2xl shadow-sm p-12 text-center">
                <div class="flex justify-center mb-4">
                    <div class="bg-blue-50 p-6 rounded-full">
                        <svg class="w-10 h-10 text-[#1a73e8]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                </div>
                <h2 class="text-lg font-bold text-gray-700">
                    Tidak Ada Buku Ditemukan
                </h2>
                <p class="text-sm text-gray-400 mt-1">Coba ubah kata kunci pencarian atau filter.</p>
            </div>
            @endif

            <!-- Pagination -->
            <div class="pb-4">
                {{ $dataBuku->links() }}
            </div>

        </div>
    </div>
</x-app-layout>
