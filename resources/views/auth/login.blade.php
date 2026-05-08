<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - BiblioTech</title>
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
                        Kelola Buku,<br>
                        Peminjaman, dan<br>
                        Riwayat dengan Mudah
                    </h1>

                    <p class="text-gray-300 leading-relaxed text-sm max-w-md">
                        BiblioTech membantu pengelolaan perpustakaan secara digital
                        dengan sistem peminjaman, pengembalian, verifikasi buku,
                        ulasan pembaca, dan monitoring aktivitas pengguna
                        secara terintegrasi.
                    </p>
                </div>

                {{-- Footer Branding --}}
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
                            Selamat Datang Kembali
                        </h2>

                        <p class="text-gray-500 mt-2">
                            Login ke akun BiblioTech untuk melanjutkan.
                        </p>
                    </div>

                    {{-- Session Status --}}
                    @if (session('status'))
                        <div class="mb-6 p-4 rounded-2xl bg-green-50 border border-green-200 text-green-700 text-sm">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{-- Error --}}
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
                          action="{{ route('login') }}"
                          class="space-y-6">
                        @csrf

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
                                autofocus
                                placeholder="Masukkan email"
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

                        {{-- Remember --}}
                       {{-- <div class="flex items-center justify-between text-sm">

                            <label class="flex items-center gap-2 text-gray-600">
                                <input type="checkbox"
                                       name="remember"
                                       class="rounded border-gray-300 text-zinc-800 focus:ring-zinc-800">
                                Ingat saya
                            </label>

                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}"
                                   class="text-zinc-700 hover:text-zinc-900 font-medium transition">
                                    Lupa password?
                                </a>
                            @endif

                        </div>
--}}
                        {{-- Button --}}
                        <button
                            type="submit"
                            class="w-full py-3 rounded-2xl bg-zinc-800 text-white font-semibold
                                   hover:bg-zinc-700 transition shadow-sm">
                            Masuk ke BiblioTech
                        </button>

                        {{-- Register --}}
                        <div class="text-center pt-2 text-sm text-gray-600">
                            Belum punya akun?
                            <a href="{{ route('register') }}"
                               class="font-semibold text-zinc-800 hover:text-zinc-700 transition">
                                Daftar sekarang
                            </a>
                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</body>
</html>
