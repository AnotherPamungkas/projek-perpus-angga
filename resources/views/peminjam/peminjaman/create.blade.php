<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Form Peminjaman</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gradient-to-br from-gray-100 to-gray-200 min-h-screen">

    {{-- HEADER --}}
    <div class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-5xl mx-auto px-6 py-4 flex items-center justify-between">


            <h1 class="font-semibold text-[#09637E]">
                Form Peminjaman Buku
            </h1>

            <div></div>

        </div>
    </div>

    {{-- CONTENT --}}
    <div class="max-w-5xl mx-auto px-6 py-12">

        <a href="{{ route('peminjam.buku.detail', $buku->id) }}"
            class="flex items-center gap-2 text-[#09637E] hover:text-[#088395] transition group mb-6">

            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 group-hover:-translate-x-1 transition-transform"
                fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
            </svg>

            <span class="text-lg font-medium">Kembali</span>
        </a>

        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">

            <div class="grid grid-cols-1 md:grid-cols-2">

                {{-- COVER --}}
                <div class="bg-gray-50 flex items-center justify-center p-10">

                    <img src="{{ $buku->cover
                        ? asset('storage/'.$buku->cover)
                        : asset('images/default-book.png') }}"
                        class="w-64 h-96 object-cover rounded-xl shadow-lg hover:scale-105 transition duration-300">
                </div>

                {{-- FORM --}}
                <div class="p-10">

                    {{-- Alert --}}
                    @if(session('error'))
                    <div class="bg-red-100 text-red-600 p-3 rounded-lg mb-6 text-sm">
                        {{ session('error') }}
                    </div>
                    @endif

                    @if($errors->any())
                    <div class="bg-red-100 text-red-600 p-3 rounded-lg mb-6 text-sm">
                        {{ $errors->first() }}
                    </div>
                    @endif

                    <h2 class="text-2xl font-bold text-[#09637E] mb-2">
                        {{ $buku->judul_buku }}
                    </h2>

                    <p class="text-gray-600 text-sm mb-6">
                        Oleh {{ $buku->pengarang }}
                    </p>

                    <form method="POST" action="{{ route('peminjam.form-peminjaman.store') }}">
                        @csrf

                        <input type="hidden" name="buku_id" value="{{ $buku->id }}">

                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Tanggal Pengembalian
                            </label>

                            <input type="date" name="tanggal_jatuh_tempo"
                                class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-[#09637E] focus:outline-none transition"
                                min="{{ date('Y-m-d', strtotime('+1 day')) }}" required>
                        </div>

                        <button type="submit" class="w-full bg-[#09637E] text-white py-3 rounded-xl font-semibold
                                   hover:bg-[#088395] transition shadow-md hover:shadow-lg">
                            Ajukan Peminjaman
                        </button>

                    </form>

                    <div class="mt-6 text-xs text-gray-500">
                        * Kamu hanya dapat meminjam 1 buku dalam satu waktu.
                    </div>

                </div>

            </div>

        </div>

    </div>

    {{-- FOOTER --}}
    <div class="text-center text-xs text-gray-500 py-6">
        © {{ date('Y') }} Sistem Perpustakaan
    </div>

</body>

</html>
