<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Form Peminjaman</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-[#F4F4F2] text-[#3D3D3B]">

    {{-- CONTENT --}}
    <div class="max-w-6xl mx-auto px-6 py-8">

        {{-- MAIN CARD --}}
        <div class="bg-white rounded-3xl shadow-sm border border-[#BBBFCA] overflow-hidden">

            {{-- HEADER --}}
            <div class="px-8 py-5 bg-[#3D3D3B] flex items-center justify-between">

                {{-- Back Button --}}
                <a href="{{ route('peminjam.buku.detail', $buku->id) }}"
                    class="flex items-center gap-2 text-white/80 hover:text-white transition group text-sm font-semibold">

                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-4 h-4 group-hover:-translate-x-1 transition-transform duration-200"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="2.5">
                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M15 19l-7-7 7-7" />
                    </svg>

                    Kembali
                </a>

                {{-- Title --}}
                <h1 class="text-white font-bold text-lg tracking-wide">
                    Form Peminjaman Buku
                </h1>

                {{-- Spacer --}}
                <div class="w-16"></div>

            </div>

            {{-- BODY --}}
            <div class="p-8">

                <div class="grid grid-cols-1 md:grid-cols-3 gap-10">

                    {{-- LEFT SIDE --}}
                    <div class="md:col-span-1">

                        <div class="sticky top-8">

                            {{-- Cover --}}
                            <img src="{{ $buku->cover
                                ? asset('storage/cover-buku/'.$buku->cover)
                                : asset('images/default-book.png') }}"
                                class="w-full h-[420px] object-cover rounded-2xl shadow-md border border-[#BBBFCA]">

                            {{-- Info Card --}}
                            <div class="mt-5 bg-[#E8E8E8] rounded-2xl p-5 border border-[#BBBFCA]">

                                <h3 class="font-bold text-sm mb-4">
                                    Informasi Buku
                                </h3>

                                <div class="space-y-3 text-sm">

                                    <div class="flex justify-between">
                                        <span class="text-[#6B6B6B]">
                                            Pengarang
                                        </span>
                                        <span class="font-medium text-right">
                                            {{ $buku->pengarang }}
                                        </span>
                                    </div>

                                    <div class="flex justify-between">
                                        <span class="text-[#6B6B6B]">
                                            Kategori
                                        </span>
                                        <span class="font-medium text-right">
                                            {{ $buku->kategori->nama_kategori ?? 'Tanpa Kategori' }}
                                        </span>
                                    </div>

                                    <div class="flex justify-between">
                                        <span class="text-[#6B6B6B]">
                                            Tahun
                                        </span>
                                        <span class="font-medium">
                                            {{ $buku->tahun_terbit }}
                                        </span>
                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                    {{-- RIGHT SIDE --}}
                    <div class="md:col-span-2">

                        {{-- Alert Error --}}
                        @if(session('error'))
                            <div class="mb-5 bg-red-50 border border-red-200 text-red-600 px-4 py-4 rounded-2xl text-sm">
                                {{ session('error') }}
                            </div>
                        @endif

                        @if($errors->any())
                            <div class="mb-5 bg-red-50 border border-red-200 text-red-600 px-4 py-4 rounded-2xl text-sm">
                                {{ $errors->first() }}
                            </div>
                        @endif

                        {{-- Book Title --}}
                        <div>
                            <h2 class="text-3xl font-bold leading-snug text-[#3D3D3B]">
                                {{ $buku->judul_buku }}
                            </h2>

                            <p class="mt-2 text-sm text-[#6B6B6B]">
                                Lengkapi tanggal pengembalian untuk mengajukan peminjaman buku.
                            </p>
                        </div>

                        {{-- Divider --}}
                        <div class="border-t border-[#BBBFCA] my-6"></div>

                        {{-- Guide Card --}}
                        <div class="bg-[#F4F4F2] border border-[#BBBFCA] rounded-2xl p-5 mb-6">

                            <h3 class="font-semibold text-sm mb-3">
                                Panduan Peminjaman
                            </h3>

                            <ul class="space-y-2 text-sm text-[#6B6B6B]">
                                <li>• Pastikan tanggal pengembalian dipilih dengan benar.</li>
                                <li>• Buku hanya bisa dipinjam satu per akun.</li>
                                <li>• Keterlambatan pengembalian dapat dikenakan denda.</li>
                            </ul>

                        </div>

                        {{-- Form Card --}}
                        <div class="bg-white border border-[#BBBFCA] rounded-2xl p-6">

                            <form method="POST" action="{{ route('peminjam.form-peminjaman.store') }}">
                                @csrf

                                <input type="hidden" name="buku_id" value="{{ $buku->id }}">

                                {{-- Input Date --}}
                                <div class="mb-6">

                                    <label class="block text-sm font-semibold mb-2 text-[#3D3D3B]">
                                        Tanggal Pengembalian
                                    </label>

                                    <input type="date"
                                        name="tanggal_jatuh_tempo"
                                        min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                                        required
                                        class="w-full border border-[#BBBFCA] rounded-2xl px-4 py-4 text-sm bg-[#F4F4F2] focus:ring-2 focus:ring-[#6B6B6B] focus:outline-none focus:bg-white transition">

                                    <p class="mt-2 text-xs text-[#6B6B6B]">
                                        Pilih tanggal kapan buku akan dikembalikan.
                                    </p>

                                </div>

                                {{-- Submit Button --}}
                                <button type="submit"
                                    class="w-full flex items-center justify-center gap-2 py-4 rounded-2xl font-semibold text-sm bg-[#3D3D3B] text-white hover:bg-[#2E2E2D] active:scale-[0.98] transition-all duration-300 shadow-sm">

                                    <svg class="w-4 h-4"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24">

                                        <path stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                    </svg>

                                    Ajukan Peminjaman

                                </button>

                            </form>

                        </div>

                        {{-- Info --}}
                        <div class="mt-5 text-xs text-[#6B6B6B]">
                            * Setelah pengajuan, petugas akan memproses permintaan peminjaman kamu.
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    {{-- FOOTER --}}
    <div class="text-center text-xs text-[#6B6B6B] py-6">
        © {{ date('Y') }} Sistem Perpustakaan
    </div>

</body>

</html>
