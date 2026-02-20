<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyLibrary - Perpustakaan Digital Modern</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#EBF4F6] text-gray-700">

<!-- ================= NAVBAR ================= -->
<header class="bg-white border-b border-[#7AB2B2]/30">
    <div class="max-w-6xl mx-auto px-6 py-4 flex justify-between items-center">
        <h1 class="text-xl font-bold text-[#09637E]">MyLibrary</h1>
        <div class="space-x-6 text-sm">
            <a href="#" class="hover:text-[#088395] transition">Beranda</a>
            <a href="#" class="hover:text-[#088395] transition">Koleksi</a>
            <a href="{{ route('login') }}" class="text-[#088395] font-medium hover:text-[#09637E]">Login</a>
            <a href="{{ route('register') }}"
               class="bg-[#088395] text-white px-4 py-2 rounded-xl hover:bg-[#09637E] transition">
               Daftar
            </a>
        </div>
    </div>
</header>


<!-- ================= HERO ================= -->
<section class="py-20">
    <div class="max-w-6xl mx-auto px-6 grid md:grid-cols-2 gap-12 items-center">

        <div>
            <h2 class="text-4xl md:text-5xl font-bold text-[#09637E] leading-tight mb-6">
                Perpustakaan Digital Modern untuk Generasi Akademik
            </h2>

            <p class="text-gray-600 mb-8 leading-relaxed">
                Pinjam buku secara online, pantau status peminjaman,
                dan berikan ulasan dengan sistem yang clean, modern, dan profesional.
            </p>

            <div class="flex gap-4">
                <a href="{{ route('register') }}"
                   class="bg-[#088395] text-white px-6 py-3 rounded-xl hover:bg-[#09637E] transition shadow-md">
                   Mulai Sekarang
                </a>

                <a href="#koleksi"
                   class="border border-[#7AB2B2] text-[#088395] px-6 py-3 rounded-xl hover:bg-[#7AB2B2]/20 transition">
                   Lihat Koleksi
                </a>
            </div>
        </div>

        <!-- Visual Placeholder -->
        <div class="bg-white rounded-3xl shadow-lg p-8 border border-[#7AB2B2]/30">
            <div class="h-56 bg-[#EBF4F6] rounded-2xl flex items-center justify-center text-[#7AB2B2]">
                Preview Dashboard
            </div>
        </div>

    </div>
</section>


<!-- ================= CARA KERJA ================= -->
<section class="bg-white py-20">
    <div class="max-w-6xl mx-auto px-6 text-center">
        <h3 class="text-3xl font-bold text-[#09637E] mb-12">
            Cara Kerja MyLibrary
        </h3>

        <div class="grid md:grid-cols-3 gap-10">

            <div class="p-6 rounded-2xl border border-[#7AB2B2]/30">
                <h4 class="font-semibold text-[#088395] mb-3">1. Cari Buku</h4>
                <p class="text-sm text-gray-600">
                    Jelajahi koleksi digital dan temukan buku yang Anda butuhkan.
                </p>
            </div>

            <div class="p-6 rounded-2xl border border-[#7AB2B2]/30">
                <h4 class="font-semibold text-[#088395] mb-3">2. Pinjam Online</h4>
                <p class="text-sm text-gray-600">
                    Lakukan peminjaman secara instan dan pantau statusnya.
                </p>
            </div>

            <div class="p-6 rounded-2xl border border-[#7AB2B2]/30">
                <h4 class="font-semibold text-[#088395] mb-3">3. Beri Ulasan</h4>
                <p class="text-sm text-gray-600">
                    Setelah mengembalikan buku, berikan rating dan ulasan.
                </p>
            </div>

        </div>
    </div>
</section>


<!-- ================= PREVIEW BUKU ================= -->
<section id="koleksi" class="py-20">
    <div class="max-w-6xl mx-auto px-6">
        <h3 class="text-3xl font-bold text-[#09637E] text-center mb-12">
            Koleksi Populer
        </h3>

        <div class="grid md:grid-cols-3 gap-8">

            <div class="bg-white rounded-2xl shadow-md border border-[#7AB2B2]/30 p-4">
                <div class="h-40 bg-[#EBF4F6] rounded-xl mb-4"></div>
                <h4 class="font-semibold text-[#09637E]">Judul Buku</h4>
                <p class="text-sm text-gray-500">Kategori</p>
            </div>

            <div class="bg-white rounded-2xl shadow-md border border-[#7AB2B2]/30 p-4">
                <div class="h-40 bg-[#EBF4F6] rounded-xl mb-4"></div>
                <h4 class="font-semibold text-[#09637E]">Judul Buku</h4>
                <p class="text-sm text-gray-500">Kategori</p>
            </div>

            <div class="bg-white rounded-2xl shadow-md border border-[#7AB2B2]/30 p-4">
                <div class="h-40 bg-[#EBF4F6] rounded-xl mb-4"></div>
                <h4 class="font-semibold text-[#09637E]">Judul Buku</h4>
                <p class="text-sm text-gray-500">Kategori</p>
            </div>

        </div>
    </div>
</section>


<!-- ================= STATISTIK ================= -->
<section class="bg-[#09637E] py-16 text-white">
    <div class="max-w-6xl mx-auto px-6 grid md:grid-cols-3 text-center gap-8">

        <div>
            <h4 class="text-3xl font-bold">500+</h4>
            <p class="text-sm text-[#CFEDEE]">Buku Tersedia</p>
        </div>

        <div>
            <h4 class="text-3xl font-bold">1.200+</h4>
            <p class="text-sm text-[#CFEDEE]">Pengguna Aktif</p>
        </div>

        <div>
            <h4 class="text-3xl font-bold">3.500+</h4>
            <p class="text-sm text-[#CFEDEE]">Ulasan Diberikan</p>
        </div>

    </div>
</section>


<!-- ================= CTA FINAL ================= -->
<section class="py-20 text-center">
    <div class="max-w-3xl mx-auto px-6">
        <h3 class="text-3xl font-bold text-[#09637E] mb-6">
            Siap Memulai Perjalanan Membaca Anda?
        </h3>

        <a href="{{ route('register') }}"
           class="bg-[#088395] text-white px-8 py-4 rounded-xl hover:bg-[#09637E] transition shadow-md">
           Buat Akun Sekarang
        </a>
    </div>
</section>


<!-- ================= FOOTER ================= -->
<footer class="bg-white border-t border-[#7AB2B2]/30 py-8">
    <div class="max-w-6xl mx-auto px-6 text-center text-sm text-gray-500">
        © 2026 MyLibrary. All rights reserved.
    </div>
</footer>

</body>
</html>
