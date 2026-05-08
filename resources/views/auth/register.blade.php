<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - BiblioTech</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-gray-100 flex items-center">

    <div class="max-w-6xl mx-auto w-full px-6 py-10">

        <div class="grid lg:grid-cols-2 bg-white rounded-[32px] shadow-xl overflow-hidden border border-gray-200">

            {{-- LEFT SIDE --}}
            <div class="hidden lg:flex bg-zinc-800 text-white p-12 flex-col justify-between">

                <div>
                    {{-- Brand Badge --}}
                    <div class="inline-flex items-center gap-3 px-5 py-3 rounded-2xl bg-zinc-700 mb-8">
                        <div class="w-10 h-10 rounded-xl bg-white text-zinc-800 flex items-center justify-center font-bold text-lg">
                            B
                        </div>

                        <div>
                            <h2 class="font-bold text-lg">
                                BiblioTech
                            </h2>
                            <p class="text-xs text-gray-300">
                                Smart Digital Library System
                            </p>
                        </div>
                    </div>

                    {{-- Main Heading --}}
                    <h1 class="text-4xl font-bold leading-tight mb-6">
                        Mulai Perjalanan<br>
                        Membaca dan<br>
                        Belajar Bersama
                    </h1>

                    <p class="text-gray-300 leading-relaxed text-sm max-w-md">
                        Daftarkan akun Anda di BiblioTech untuk mulai
                        mengakses koleksi buku, melakukan peminjaman,
                        memberi ulasan, dan menikmati sistem perpustakaan
                        digital yang lebih modern.
                    </p>
                </div>

                {{-- Footer --}}
                <div class="pt-10 border-t border-zinc-700">
                    <p class="text-sm text-gray-400">
                        BiblioTech © {{ date('Y') }}
                    </p>
                </div>

            </div>

            {{-- RIGHT SIDE --}}
            <div class="p-8 sm:p-12 flex items-center">

                <div class="w-full max-w-md mx-auto">

                    {{-- Mobile Branding --}}
                    <div class="lg:hidden mb-8 text-center">

                        <div class="w-16 h-16 mx-auto rounded-2xl bg-zinc-800 text-white
                                    flex items-center justify-center text-2xl font-bold mb-4">
                            B
                        </div>

                        <h1 class="text-2xl font-bold text-zinc-800">
                            BiblioTech
                        </h1>

                        <p class="text-sm text-gray-500 mt-1">
                            Smart Digital Library System
                        </p>

                    </div>

                    {{-- Header --}}
                    <div class="mb-8">
                        <h2 class="text-3xl font-bold text-zinc-800">
                            Buat Akun Baru
                        </h2>

                        <p class="text-gray-500 mt-2">
                            Lengkapi data berikut untuk mulai menggunakan BiblioTech.
                        </p>
                    </div>

                    {{-- Global Errors --}}
                    @if ($errors->any())
                        <div class="mb-6 p-4 rounded-2xl bg-red-50 border border-red-200">
                            <ul class="space-y-1 text-sm text-red-600">
                                @foreach ($errors->all() as $error)
                                    <li>- {{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- Form --}}
                    <form method="POST"
                          action="{{ route('register') }}"
                          class="space-y-5">
                        @csrf

                        {{-- Nama --}}
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Nama Lengkap
                            </label>

                            <input
                                type="text"
                                name="nama"
                                value="{{ old('nama') }}"
                                required
                                placeholder="Masukkan nama lengkap"
                                class="w-full rounded-2xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm
                                       focus:ring-2 focus:ring-zinc-800 focus:border-zinc-800
                                       focus:bg-white transition">
                        </div>

                        {{-- Username --}}
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Username
                            </label>

                            <input
                                type="text"
                                name="username"
                                value="{{ old('username') }}"
                                required
                                placeholder="Masukkan username"
                                class="w-full rounded-2xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm
                                       focus:ring-2 focus:ring-zinc-800 focus:border-zinc-800
                                       focus:bg-white transition">
                        </div>

                        {{-- Email --}}
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Email
                            </label>

                            <input
                                type="email"
                                name="email"
                                value="{{ old('email') }}"
                                required
                                placeholder="Masukkan email aktif"
                                class="w-full rounded-2xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm
                                       focus:ring-2 focus:ring-zinc-800 focus:border-zinc-800
                                       focus:bg-white transition">
                        </div>

                        {{-- Password --}}
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Password
                            </label>

                            <input
                                type="password"
                                name="password"
                                required
                                placeholder="Masukkan password"
                                class="w-full rounded-2xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm
                                       focus:ring-2 focus:ring-zinc-800 focus:border-zinc-800
                                       focus:bg-white transition">
                        </div>

                        {{-- Confirm Password --}}
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Konfirmasi Password
                            </label>

                            <input
                                type="password"
                                name="password_confirmation"
                                required
                                placeholder="Ulangi password"
                                class="w-full rounded-2xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm
                                       focus:ring-2 focus:ring-zinc-800 focus:border-zinc-800
                                       focus:bg-white transition">
                        </div>

                        {{-- Button --}}
                        <button
                            type="submit"
                            class="w-full py-3 rounded-2xl bg-zinc-800 text-white font-semibold
                                   hover:bg-zinc-700 transition shadow-sm">
                            Daftar ke BiblioTech
                        </button>

                        {{-- Login Link --}}
                        <div class="text-center pt-2 text-sm text-gray-600">
                            Sudah punya akun?
                            <a href="{{ route('login') }}"
                               class="font-semibold text-zinc-800 hover:text-zinc-700 transition">
                                Login sekarang
                            </a>
                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</body>
</html>
