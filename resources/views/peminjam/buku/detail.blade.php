<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>{{ $buku->judul_buku }}</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100">

    {{-- HEADER --}}
    <div class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-6xl mx-auto px-6 py-4 flex items-center justify-between">
            <div class="font-bold text-[#09637E]">
                Detail Buku
            </div>

        </div>
    </div>


    {{-- CONTENT --}}
    <div class="max-w-6xl mx-auto px-6 py-10">

        {{-- Back Button --}}
        <div class="flex items-center gap-4 mb-6">
            <a href="{{ route('peminjam.buku.index') }}"
                class="flex items-center gap-2 text-[#09637E] hover:text-[#088395] transition group">

                <svg xmlns="http://www.w3.org/2000/svg"
                    class="w-6 h-6 group-hover:-translate-x-1 transition-transform duration-200" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">

                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>

                <span class="text-lg font-medium">
                    Kembali
                </span>
            </a>

        </div>

        <div class="bg-white rounded-2xl shadow-lg p-8">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-10">

                {{-- COVER --}}
                <div>
                    <img src="{{ $buku->cover
                        ? asset('storage/'.$buku->cover)
                        : asset('images/default-book.png') }}"
                        class="w-full h-[450px] object-cover rounded-xl shadow-md">
                </div>

                {{-- INFO --}}
                <div class="flex flex-col justify-between">

                    <div>
                        {{-- Badge kategori --}}
                        <span class="px-3 py-1 text-xs rounded-full bg-[#7AB2B2]/20 text-[#09637E] font-semibold">
                            {{ $buku->kategori->nama_kategori ?? 'Tanpa Kategori' }}
                        </span>

                        <h1 class="text-3xl font-bold text-[#09637E] mt-4">
                            {{ $buku->judul_buku }}
                        </h1>

                        <p class="text-gray-600 mt-2">
                            Oleh <span class="font-semibold">{{ $buku->pengarang }}</span>
                        </p>

                        <div class="mt-4 space-y-1 text-sm text-gray-600">
                            <p>Penerbit: {{ $buku->penerbit }}</p>
                            <p>Tahun: {{ $buku->tahun_terbit }}</p>
                            <p>Stok: {{ $stokTersedia }}</p>
                            <p>Total Favorit: {{ $totalFavorit }}</p>
                        </div>

                        {{-- STATUS --}}
                        <div class="mt-4">
                            @if($buku->status == 'tersedia')
                            <span class="px-4 py-1 rounded-full bg-green-100 text-green-700 text-sm font-medium">
                                Tersedia
                            </span>
                            @else
                            <span class="px-4 py-1 rounded-full bg-red-100 text-red-600 text-sm font-medium">
                                Sedang Dipinjam
                            </span>
                            @endif
                        </div>
                    </div>

                    {{-- ACTION --}}
                    <div class="mt-6 space-y-3">

                        {{-- Favorit --}}
                        <form action="{{ route('peminjam.buku.favorit', $buku->id) }}" method="POST">
                            @csrf
                            <button class="w-full py-3 rounded-xl font-semibold transition
                            {{ $isFavorit
                                ? 'bg-red-100 text-red-600 hover:bg-red-200'
                                : 'bg-[#EBF4F6] text-[#09637E] hover:bg-[#7AB2B2]/30' }}">

                                {{ $isFavorit ? '❤️ Hapus dari Favorit' : '🤍 Tambahkan ke Favorit' }}
                            </button>
                        </form>

                        {{-- Pinjam --}}
                        @if(!$profilLengkap)

                        <div class="bg-yellow-50 border border-yellow-200 text-yellow-700 p-4 rounded-xl text-sm">
                            <p class="font-semibold">Profil belum lengkap</p>
                            <p class="mt-1">
                                Silakan lengkapi profil terlebih dahulu sebelum melakukan peminjaman.
                            </p>

                            <a href="{{ route('profil-peminjam.index') }}"
                                class="inline-block mt-3 text-[#09637E] font-semibold hover:underline">
                                Lengkapi Profil
                            </a>
                        </div>

                        <button disabled
                            class="w-full py-3 rounded-xl font-semibold bg-gray-200 text-gray-400 cursor-not-allowed">
                            Ajukan Peminjaman
                        </button>

                        @elseif(!$isDipinjam && $buku->status == 'tersedia')

                        <a href="{{ route('peminjam.form-peminjaman', $buku->id) }}"
                            class="block text-center bg-[#09637E] text-white py-3 rounded-xl font-semibold hover:bg-[#088395] transition shadow-md">
                            Ajukan Peminjaman
                        </a>

                        @elseif($isDipinjam)

                        <div class="text-center py-3 rounded-xl bg-yellow-100 text-yellow-700 font-medium">
                            Buku sedang kamu pinjam
                        </div>

                        @else

                        <div class="text-center py-3 rounded-xl bg-gray-200 text-gray-600 font-medium">
                            Buku tidak tersedia
                        </div>

                        @endif

                    </div>

                </div>

            </div>

            {{-- DESKRIPSI --}}
            <div class="mt-10 border-t pt-8">
                <h3 class="text-lg font-semibold text-[#09637E] mb-3">
                    Deskripsi Buku
                </h3>

                <p class="text-gray-700 leading-relaxed">
                    {{ $buku->deskripsi ?? 'Tidak ada deskripsi tersedia.' }}
                </p>
            </div>

        </div>

    </div>


    {{-- FOOTER MINIMAL --}}
    <div class="text-center text-sm text-gray-500 py-6">
        © {{ date('Y') }} Sistem Perpustakaan
    </div>

</body>

</html>
