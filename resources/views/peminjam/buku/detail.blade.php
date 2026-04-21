<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>{{ $buku->judul_buku }}</title>
    @vite('resources/css/app.css')
</head>

<body style="background-color: #f0f4f8;">

    {{-- CONTENT --}}
    <div class="max-w-6xl mx-auto px-6 py-8">

        <div class="bg-white rounded-2xl shadow-sm overflow-hidden">

            {{-- HEADER (inside card, gradient biru tua → biru muda) --}}
            <div class="px-8 py-5 flex items-center justify-between"
                style="background: linear-gradient(135deg, #1557b0 0%, #1a73e8 55%, #4da3ff 100%);">

                <a href="{{ route('peminjam.buku.index') }}"
                    class="flex  rounded-md items-center gap-2 text-white/90 hover:text-white transition group text-sm font-semibold">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-4 h-4 group-hover:-translate-x-1 transition-transform duration-200" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                    </svg>
                    Kembali
                </a>

                <h1 class="text-white font-bold text-lg tracking-wide">
                    Detail Buku
                </h1>

                {{-- Spacer agar judul tetap center --}}
                <!-- <div class="w-16"></div> -->

            </div>

            {{-- BODY --}}
            <div class="p-8">

                <div class="grid grid-cols-1 md:grid-cols-3 gap-10">

                    {{-- COVER --}}
                    <div class="md:col-span-1">
                        <img src="{{ $buku->cover
                            ? asset('storage/cover-buku/'.$buku->cover)
                            : asset('images/default-book.png') }}"
                            class="w-full h-[380px] object-cover rounded-xl shadow-md">
                    </div>

                    {{-- INFO --}}
                    <div class="md:col-span-2 flex flex-col justify-between">

                        <div>
                            {{-- Judul --}}
                            <h1 class="text-3xl font-bold text-blue-800 leading-snug">
                                {{ $buku->judul_buku }}
                            </h1>

                            {{-- Meta info row --}}
                            <div class="flex flex-wrap items-center gap-4 mt-2 text-sm text-gray-500">
                                <span class="flex items-center gap-1 text-lg">
                                    <svg class="w-6 h-6 text-[#1a73e8]" fill="#1a73e8" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    {{ $buku->pengarang }}
                                </span>
                                <span class="flex items-center gap-1 text-lg">
                                    <svg class="w-6 h-6 text-[#1a73e8]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    {{ $buku->tahun_terbit }}
                                </span>
                                <span class="flex items-center gap-1 text-lg">
                                    <svg class="w-6 h-6 text-[#1a73e8]" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M17.707 9.293a1 1 0 010 1.414l-7 7a1 1 0 01-1.414 0l-7-7A.997.997 0 012 10V5a3 3 0 013-3h5c.256 0 .512.098.707.293l7 7zM5 6a1 1 0 100-2 1 1 0 000 2z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <span class="font-medium">
                                        {{ $buku->kategori->nama_kategori ?? 'Tanpa Kategori' }}
                                    </span>
                                </span>
                            </div>

                            {{-- Info tambahan --}}
                            <div class="mt-4 flex flex-wrap gap-4 text-sm text-gray-500">
                                <span>Penerbit: <span class="text-gray-700 font-medium">{{ $buku->penerbit }}</span></span>
                                <span>Stok: <span class="text-gray-700 font-medium">{{ $stokTersedia }}</span></span>
                                <span>Favorit: <span class="text-gray-700 font-medium">{{ $totalFavorit }}</span></span>
                            </div>

                            {{-- STATUS --}}
                            <div class="mt-4">
                                @if($buku->status == 'tersedia')
                                <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-xs font-semibold">
                                    ● Tersedia
                                </span>
                                @else
                                <span class="px-3 py-1 rounded-full bg-red-100 text-red-600 text-xs font-semibold">
                                    ● Sedang Dipinjam
                                </span>
                                @endif
                            </div>

                            {{-- ACTION BUTTONS --}}
                            <div class="mt-6 flex flex-wrap gap-3">

                                @if(!$profilLengkap)
                                <button disabled
                                    class="flex items-center gap-2 px-5 py-2.5 rounded-xl font-semibold text-sm bg-gray-200 text-gray-400 cursor-not-allowed">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                    </svg>
                                    Ajukan Peminjaman
                                </button>

                                @elseif(!$isDipinjam && $buku->status == 'tersedia')
                                <a href="{{ route('peminjam.form-peminjaman', $buku->id) }}"
                                    class="flex items-center gap-2 px-5 py-2.5 rounded-xl font-semibold text-sm text-white bg-gradient-to-r from-[#1557b0] to-[#4da3ff] hover:bg-[#1a73e8] transition shadow-sm"
                                    >
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                    </svg>
                                    Ajukan Peminjaman
                                </a>

                                @elseif($isDipinjam)
                                <span
                                    class="flex items-center gap-2 px-5 py-2.5 rounded-xl font-semibold text-sm bg-yellow-100 text-yellow-700">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    Sedang Kamu Pinjam
                                </span>

                                @else
                                <span
                                    class="flex items-center gap-2 px-5 py-2.5 rounded-xl font-semibold text-sm bg-gray-100 text-gray-500">
                                    Buku Tidak Tersedia
                                </span>
                                @endif

                                {{-- Favorit --}}
                                <form action="{{ route('peminjam.buku.favorit', $buku->id) }}" method="POST">
                                    @csrf
                                    <button
                                        class="flex items-center gap-2 px-5 py-2.5 rounded-xl font-semibold text-sm border transition
                                        {{ $isFavorit
                                            ? 'border-red-300 bg-red-50 text-red-500 hover:bg-red-100'
                                            : 'border-gray-200 bg-white text-gray-500 hover:bg-gray-50' }}">
                                        @if($isFavorit)
                                        <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                                            <path
                                                d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" />
                                        </svg>
                                        Hapus Favorit
                                        @else
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4.318 6.318a4 4 0 015.656 0L12 8.344l2.026-2.026a4 4 0 115.656 5.656L12 19.656 4.318 11.974a4 4 0 010-5.656z" />
                                        </svg>
                                        Favorit
                                        @endif
                                    </button>
                                </form>

                            </div>

                            {{-- Warning profil belum lengkap --}}
                            @if(!$profilLengkap)
                            <div class="mt-4 bg-yellow-50 border border-yellow-200 text-yellow-700 p-4 rounded-xl text-sm">
                                <p class="font-semibold">Profil belum lengkap</p>
                                <p class="mt-1">Silakan lengkapi profil terlebih dahulu sebelum melakukan peminjaman.</p>
                                <a href="{{ route('profil-peminjam.index') }}"
                                    class="inline-block mt-2 text-[#1a73e8] font-semibold hover:underline text-sm">
                                    Lengkapi Profil →
                                </a>
                            </div>
                            @endif

                        </div>

                    </div>

                </div>

                {{-- DESKRIPSI --}}
                <div class="mt-8 border-t border-gray-100 pt-6">
                    <h3 class="text-base font-bold text-gray-700 mb-3">
                        Komentar
                    </h3>
                    <p class="text-gray-600 leading-relaxed text-sm">
                        {{ $buku->deskripsi ?? 'Tidak ada deskripsi tersedia.' }}
                    </p>
                </div>

            </div>
        </div>

    </div>

    {{-- FOOTER MINIMAL --}}
    <div class="text-center text-xs text-gray-400 py-6">
        © {{ date('Y') }} Sistem Perpustakaan
    </div>

</body>

</html>
