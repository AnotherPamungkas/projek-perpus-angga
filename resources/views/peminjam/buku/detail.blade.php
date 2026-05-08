<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>{{ $buku->judul_buku }}</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-[#F4F4F2] text-[#3D3D3B]">

    <div class="min-h-screen">

        {{-- Container --}}
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

            {{-- Header Navigation --}}
            <div class="mb-6 flex items-center justify-between">

                <a href="{{ route('peminjam.buku.index') }}"
                    class="flex items-center gap-2 px-4 py-2 rounded-xl bg-white border border-[#BBBFCA] hover:bg-[#E8E8E8] transition font-medium text-sm">

                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-4 h-4 transition-transform duration-200 group-hover:-translate-x-1"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15 19l-7-7 7-7" />
                    </svg>

                    Kembali ke Katalog
                </a>

                <h1 class="text-lg md:text-xl font-bold text-[#3D3D3B]">
                    Detail Buku
                </h1>

            </div>

            {{-- Main Card --}}
            <div class="bg-white rounded-3xl shadow-sm border border-[#BBBFCA] overflow-hidden">

                <div class="grid grid-cols-1 lg:grid-cols-5 gap-8 p-8">

                    {{-- LEFT SIDE : COVER --}}
                    <div class="lg:col-span-2">

                        <div class="sticky top-8">

                            <div class="overflow-hidden rounded-2xl border border-[#BBBFCA] shadow-sm bg-[#E8E8E8]">
                                <img src="{{ $buku->cover
                                    ? asset('storage/cover-buku/'.$buku->cover)
                                    : asset('images/default-book.png') }}"
                                    class="w-full h-[480px] object-cover">
                            </div>

                            {{-- Status --}}
                            <div class="mt-4">
                                @if($buku->status == 'tersedia')
                                    <span
                                        class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-green-100 text-green-700 text-sm font-semibold">
                                        ● Buku Tersedia
                                    </span>
                                @else
                                    <span
                                        class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-red-100 text-red-600 text-sm font-semibold">
                                        ● Sedang Dipinjam
                                    </span>
                                @endif
                            </div>

                        </div>

                    </div>

                    {{-- RIGHT SIDE : CONTENT --}}
                    <div class="lg:col-span-3">

                        {{-- Title --}}
                        <div>
                            <h1 class="text-3xl md:text-4xl font-bold leading-tight text-[#3D3D3B]">
                                {{ $buku->judul_buku }}
                            </h1>

                            <p class="mt-3 text-lg text-[#3D3D3B]/70">
                                {{ $buku->pengarang }}
                            </p>
                        </div>

                        {{-- Metadata Cards --}}
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-8">

                            <div class="bg-[#F4F4F2] border border-[#BBBFCA] rounded-2xl p-4">
                                <p class="text-xs text-[#3D3D3B]/60 mb-1">
                                    Tahun Terbit
                                </p>
                                <p class="font-semibold">
                                    {{ $buku->tahun_terbit }}
                                </p>
                            </div>

                            <div class="bg-[#F4F4F2] border border-[#BBBFCA] rounded-2xl p-4">
                                <p class="text-xs text-[#3D3D3B]/60 mb-1">
                                    Kategori
                                </p>
                                <p class="font-semibold">
                                    {{ $buku->kategori->nama_kategori ?? 'Tanpa Kategori' }}
                                </p>
                            </div>

                            <div class="bg-[#F4F4F2] border border-[#BBBFCA] rounded-2xl p-4">
                                <p class="text-xs text-[#3D3D3B]/60 mb-1">
                                    Penerbit
                                </p>
                                <p class="font-semibold">
                                    {{ $buku->penerbit }}
                                </p>
                            </div>

                            <div class="bg-[#F4F4F2] border border-[#BBBFCA] rounded-2xl p-4">
                                <p class="text-xs text-[#3D3D3B]/60 mb-1">
                                    Stok Tersedia
                                </p>
                                <p class="font-semibold">
                                    {{ $stokTersedia }}
                                </p>
                            </div>

                        </div>

                        {{-- Statistik tambahan --}}
                        <div class="flex flex-wrap gap-3 mt-6">

                            <div
                                class="px-4 py-2 rounded-xl bg-[#E8E8E8] border border-[#BBBFCA] text-sm font-medium">
                                ❤️ {{ $totalFavorit }} Favorit
                            </div>

                            <div
                                class="px-4 py-2 rounded-xl bg-[#E8E8E8] border border-[#BBBFCA] text-sm font-medium">
                                📚 {{ $stokTersedia }} Tersedia
                            </div>

                        </div>

                        {{-- Action Buttons --}}
                        <div class="mt-8 flex flex-wrap gap-4">

                            {{-- Pinjam --}}
                            @if(!$profilLengkap)

                                <button disabled
                                    class="px-5 py-3 rounded-2xl bg-gray-200 text-gray-400 font-semibold cursor-not-allowed">
                                    Ajukan Peminjaman
                                </button>

                            @elseif(!$isDipinjam && $buku->status == 'tersedia')

                                <a href="{{ route('peminjam.form-peminjaman', $buku->id) }}"
                                    class="px-6 py-3 rounded-2xl bg-[#3D3D3B] text-white font-semibold hover:opacity-90 transition shadow-sm">
                                    Ajukan Peminjaman
                                </a>

                            @elseif($isDipinjam)

                                <span
                                    class="px-5 py-3 rounded-2xl bg-yellow-100 text-yellow-700 font-semibold">
                                    Sedang Kamu Pinjam
                                </span>

                            @else

                                <span
                                    class="px-5 py-3 rounded-2xl bg-gray-100 text-gray-500 font-semibold">
                                    Buku Tidak Tersedia
                                </span>

                            @endif

                            {{-- Favorit --}}
                            <form action="{{ route('peminjam.buku.favorit', $buku->id) }}" method="POST">
                                @csrf
                                <button
                                    class="px-5 py-3 rounded-2xl border border-[#BBBFCA] font-semibold transition
                                    {{ $isFavorit
                                        ? 'bg-red-50 text-red-500 hover:bg-red-100'
                                        : 'bg-white text-[#3D3D3B] hover:bg-[#E8E8E8]' }}">

                                    @if($isFavorit)
                                        ❤️ Hapus Favorit
                                    @else
                                        🤍 Tambah Favorit
                                    @endif

                                </button>
                            </form>

                        </div>

                        {{-- Warning --}}
                        @if(!$profilLengkap)
                            <div
                                class="mt-6 bg-yellow-50 border border-yellow-200 text-yellow-700 rounded-2xl p-5">

                                <p class="font-semibold">
                                    Profil belum lengkap
                                </p>

                                <p class="text-sm mt-2">
                                    Lengkapi profil terlebih dahulu agar bisa melakukan peminjaman buku.
                                </p>

                                <a href="{{ route('profil-peminjam.index') }}"
                                    class="inline-block mt-3 font-semibold underline">
                                    Lengkapi Profil
                                </a>

                            </div>
                        @endif

                    </div>

                </div>

            </div>

            {{-- Deskripsi --}}
            <div class="mt-8 bg-white rounded-3xl shadow-sm border border-[#BBBFCA] p-8">

                <h2 class="text-xl font-bold text-[#3D3D3B] mb-4">
                    Deskripsi Buku
                </h2>

                <div class="bg-[#F4F4F2] rounded-2xl border border-[#BBBFCA] p-6">
                    <p class="leading-relaxed text-[#3D3D3B]/80">
                        {{ $buku->deskripsi ?? 'Tidak ada deskripsi tersedia.' }}
                    </p>
                </div>

            </div>

        </div>

        {{-- Footer --}}
        <div class="text-center text-sm text-[#3D3D3B]/50 py-8">
            © {{ date('Y') }} Sistem Perpustakaan
        </div>

    </div>

</body>

</html>
