<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BiblioTech - Perpustakaan Digital Modern</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 text-gray-700 antialiased">

    <!-- ================= NAVBAR ================= -->
    <header class="sticky top-0 z-50 bg-white/90 backdrop-blur-md border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">

            <div>
                <h1 class="text-2xl font-bold text-zinc-900">
                    BiblioTech
                </h1>
                <p class="text-xs text-gray-500">
                    Digital Library Platform
                </p>
            </div>

            <div class="flex items-center gap-3">
                <a href="{{ route('login') }}"
                    class="px-4 py-2 text-sm font-medium text-gray-700 hover:text-zinc-900 transition">
                    Login
                </a>

                <a href="{{ route('register') }}"
                    class="px-5 py-2.5 rounded-2xl bg-zinc-900 text-white text-sm font-semibold hover:bg-zinc-800 transition shadow-sm">
                    Daftar
                </a>
            </div>

        </div>
    </header>


    <!-- ================= HERO ================= -->
    <section class="py-24">
        <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-2 gap-14 items-center">

            <!-- Left Content -->
            <div>

                <div
                    class="inline-flex items-center px-4 py-2 rounded-full bg-white border border-gray-200 text-sm text-gray-600 mb-6 shadow-sm">
                    Platform Perpustakaan Digital Modern
                </div>

                <h2 class="text-5xl md:text-6xl font-bold text-zinc-900 leading-tight mb-6">
                    Membaca Lebih Mudah
                    dengan
                    <span class="text-gray-500">
                        BiblioTech
                    </span>
                </h2>

                <p class="text-lg text-gray-600 leading-relaxed mb-8 max-w-xl">
                    Kelola peminjaman buku, pantau riwayat, berikan ulasan,
                    dan akses koleksi perpustakaan secara digital dalam satu sistem
                    yang modern, cepat, dan efisien.
                </p>

                <div class="flex flex-wrap gap-4">

                    <a href="{{ route('register') }}"
                        class="px-7 py-4 rounded-2xl bg-zinc-900 text-white font-semibold hover:bg-zinc-800 transition shadow-sm">
                        Mulai Sekarang
                    </a>

                    <a href="#koleksi"
                        class="px-7 py-4 rounded-2xl bg-white border border-gray-200 text-gray-700 font-semibold hover:bg-gray-50 transition">
                        Lihat Koleksi
                    </a>

                </div>

            </div>

            <!-- Right Preview -->
            <div>
                <div class="bg-white rounded-3xl shadow-sm border border-gray-200 p-6">

                    <div class="bg-gray-100 rounded-2xl p-6 space-y-4">

                        <div class="h-5 bg-gray-300 rounded w-2/3"></div>
                        <div class="h-4 bg-gray-200 rounded w-full"></div>
                        <div class="h-4 bg-gray-200 rounded w-5/6"></div>

                        <div class="grid grid-cols-2 gap-4 pt-4">

                            <div class="bg-white rounded-2xl p-4 shadow-sm border border-gray-100">
                                <div class="h-20 bg-gray-100 rounded-xl"></div>
                            </div>

                            <div class="bg-white rounded-2xl p-4 shadow-sm border border-gray-100">
                                <div class="h-20 bg-gray-100 rounded-xl"></div>
                            </div>

                        </div>

                    </div>

                </div>
            </div>

        </div>
    </section>


    <!-- ================= FEATURES ================= -->
    <section class="py-20 bg-white border-y border-gray-200">
        <div class="max-w-7xl mx-auto px-6">

            <div class="text-center mb-14">
                <h3 class="text-3xl font-bold text-zinc-900">
                    Cara Kerja BiblioTech
                </h3>
                <p class="text-gray-500 mt-3">
                    Sistem sederhana untuk pengalaman membaca yang lebih efisien
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">

                <div class="bg-gray-50 rounded-3xl p-8 border border-gray-200">
                    <div class="w-12 h-12 rounded-2xl bg-zinc-900 text-white flex items-center justify-center mb-5">
                        1
                    </div>

                    <h4 class="text-lg font-bold text-zinc-900 mb-3">
                        Cari Buku
                    </h4>

                    <p class="text-gray-600 text-sm leading-relaxed">
                        Temukan berbagai koleksi buku dengan kategori yang lengkap
                        dan sistem pencarian cepat.
                    </p>
                </div>

                <div class="bg-gray-50 rounded-3xl p-8 border border-gray-200">
                    <div class="w-12 h-12 rounded-2xl bg-zinc-900 text-white flex items-center justify-center mb-5">
                        2
                    </div>

                    <h4 class="text-lg font-bold text-zinc-900 mb-3">
                        Pinjam Online
                    </h4>

                    <p class="text-gray-600 text-sm leading-relaxed">
                        Lakukan peminjaman buku secara online dengan proses
                        yang lebih praktis.
                    </p>
                </div>

                <div class="bg-gray-50 rounded-3xl p-8 border border-gray-200">
                    <div class="w-12 h-12 rounded-2xl bg-zinc-900 text-white flex items-center justify-center mb-5">
                        3
                    </div>

                    <h4 class="text-lg font-bold text-zinc-900 mb-3">
                        Beri Ulasan
                    </h4>

                    <p class="text-gray-600 text-sm leading-relaxed">
                        Bagikan pengalaman membaca untuk membantu pengguna lain
                        memilih buku terbaik.
                    </p>
                </div>

            </div>

        </div>
    </section>


    <!-- ================= KOLEKSI ================= -->
    <section id="koleksi" class="py-20">
        <div class="max-w-7xl mx-auto px-6">

            <div class="text-center mb-14">
                <h3 class="text-3xl font-bold text-zinc-900">
                    Koleksi Populer
                </h3>
                <p class="text-gray-500 mt-3">
                    Buku yang paling sering dipinjam pengguna
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">

                @for ($i = 0; $i < 3; $i++)
                <div class="bg-white rounded-3xl shadow-sm border border-gray-200 overflow-hidden">

                    <div class="h-52 bg-gray-100"></div>

                    <div class="p-6">
                        <h4 class="font-bold text-zinc-900 mb-2">
                            Judul Buku
                        </h4>

                        <p class="text-sm text-gray-500">
                            Kategori Buku
                        </p>
                    </div>

                </div>
                @endfor

            </div>

        </div>
    </section>


    <!-- ================= STATISTICS ================= -->
    <section class="py-20 bg-zinc-900 text-white">
        <div class="max-w-7xl mx-auto px-6">

            <div class="grid md:grid-cols-3 gap-8 text-center">

                <div>
                    <h4 class="text-4xl font-bold mb-2">
                        500+
                    </h4>
                    <p class="text-gray-400">
                        Buku Tersedia
                    </p>
                </div>

                <div>
                    <h4 class="text-4xl font-bold mb-2">
                        1.200+
                    </h4>
                    <p class="text-gray-400">
                        Pengguna Aktif
                    </p>
                </div>

                <div>
                    <h4 class="text-4xl font-bold mb-2">
                        3.500+
                    </h4>
                    <p class="text-gray-400">
                        Ulasan Pengguna
                    </p>
                </div>

            </div>

        </div>
    </section>


    <!-- ================= CTA ================= -->
    <section class="py-24">
        <div class="max-w-4xl mx-auto px-6">

            <div class="bg-white rounded-3xl border border-gray-200 shadow-sm p-12 text-center">

                <h3 class="text-4xl font-bold text-zinc-900 mb-5">
                    Siap Memulai?
                </h3>

                <p class="text-gray-600 mb-8 max-w-2xl mx-auto">
                    Bergabung sekarang dan nikmati pengalaman perpustakaan digital
                    yang lebih modern, praktis, dan terintegrasi.
                </p>

                <a href="{{ route('register') }}"
                    class="inline-flex px-8 py-4 rounded-2xl bg-zinc-900 text-white font-semibold hover:bg-zinc-800 transition shadow-sm">
                    Buat Akun Sekarang
                </a>

            </div>

        </div>
    </section>


    <!-- ================= FOOTER ================= -->
    <footer class="bg-white border-t border-gray-200 py-8">
        <div class="max-w-7xl mx-auto px-6 text-center text-sm text-gray-500">
            © 2026 BiblioTech. All rights reserved.
        </div>
    </footer>

</body>

</html>
