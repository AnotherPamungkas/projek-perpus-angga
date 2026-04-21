<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Form Peminjaman</title>
    @vite('resources/css/app.css')
</head>

<body style="background-color: #f0f4f8;">

    {{-- CONTENT --}}
    <div class="max-w-6xl mx-auto px-6 py-8">

        <div class="bg-white rounded-2xl shadow-sm overflow-hidden">

            {{-- HEADER (sama persis dengan detail.blade.php) --}}
            <div class="px-8 py-5 flex items-center justify-between"
                style="background: linear-gradient(135deg, #1557b0 0%, #1a73e8 55%, #4da3ff 100%);">

                <a href="{{ route('peminjam.buku.detail', $buku->id) }}"
                    class="flex items-center gap-2 text-white/90 hover:text-white transition group text-sm font-semibold">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-4 h-4 group-hover:-translate-x-1 transition-transform duration-200" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                    </svg>
                    Kembali
                </a>

                <h1 class="text-white font-bold text-lg tracking-wide">
                    Form Peminjaman
                </h1>

                {{-- Spacer agar judul tetap center --}}
                <div class="w-16"></div>

            </div>

            {{-- BODY --}}
            <div class="p-8">

                <div class="grid grid-cols-1 md:grid-cols-3 gap-10">

                    {{-- COVER --}}
                    <div class="md:col-span-1">
                        <img src="{{ $buku->cover
                            ? asset('storage/cover-buku/'.$buku->cover)
                            : asset('images/default-book.png') }}"
                            class="w-full h-[380px] object-cover rounded-xl shadow-md hover:scale-105 transition duration-300">
                    </div>

                    {{-- FORM --}}
                    <div class="md:col-span-2 flex flex-col justify-between">

                        <div>
                            {{-- Alert Error --}}
                            @if(session('error'))
                            <div class="bg-red-50 border border-red-200 text-red-600 px-4 py-3 rounded-xl mb-5 text-sm">
                                {{ session('error') }}
                            </div>
                            @endif

                            @if($errors->any())
                            <div class="bg-red-50 border border-red-200 text-red-600 px-4 py-3 rounded-xl mb-5 text-sm">
                                {{ $errors->first() }}
                            </div>
                            @endif

                            {{-- Judul & Pengarang --}}
                            <h2 class="text-2xl font-bold text-gray-800 leading-snug">
                                {{ $buku->judul_buku }}
                            </h2>

                            <div class="flex flex-wrap items-center gap-4 mt-2 text-sm text-gray-500">
                                <span class="flex items-center gap-1">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    {{ $buku->pengarang }}
                                </span>
                                <span class="flex items-center gap-1">
                                    <svg class="w-4 h-4 text-[#1a73e8]" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M17.707 9.293a1 1 0 010 1.414l-7 7a1 1 0 01-1.414 0l-7-7A.997.997 0 012 10V5a3 3 0 013-3h5c.256 0 .512.098.707.293l7 7zM5 6a1 1 0 100-2 1 1 0 000 2z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <span class="text-[#1a73e8] font-medium">
                                        {{ $buku->kategori->nama_kategori ?? 'Tanpa Kategori' }}
                                    </span>
                                </span>
                            </div>

                            {{-- Divider --}}
                            <div class="border-t border-gray-100 my-5"></div>

                            {{-- Form --}}
                            <form method="POST" action="{{ route('peminjam.form-peminjaman.store') }}">
                                @csrf
                                <input type="hidden" name="buku_id" value="{{ $buku->id }}">

                                <div class="mb-5">
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                                        Tanggal Pengembalian
                                    </label>
                                    <input type="date" name="tanggal_jatuh_tempo"
                                        class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm bg-gray-50 focus:ring-2 focus:ring-[#1a73e8] focus:outline-none focus:bg-white transition"
                                        min="{{ date('Y-m-d', strtotime('+1 day')) }}" required>
                                </div>

                                <button type="submit"
                                    class="flex items-center justify-center gap-2 w-full py-3 rounded-xl font-semibold text-sm text-white transition shadow-sm"
                                    style="background: linear-gradient(135deg, #1557b0 0%, #1a73e8 55%, #4da3ff 100%);">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                    </svg>
                                    Ajukan Peminjaman
                                </button>

                            </form>

                            <p class="mt-4 text-xs text-gray-400">
                                * Kamu hanya dapat meminjam 1 buku dalam satu waktu.
                            </p>

                        </div>

                    </div>

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
