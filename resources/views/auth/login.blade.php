<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - MyLibrary</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#EBF4F6] min-h-screen flex items-center">

    <div class="max-w-5xl mx-auto w-full px-6">
        <div class="grid md:grid-cols-2 bg-white rounded-3xl shadow-xl overflow-hidden border border-[#7AB2B2]/30">

            <!-- LEFT: BRANDING -->
            <div class="bg-[#09637E] text-white p-10 flex flex-col justify-center">
                <h1 class="text-4xl font-bold mb-4 tracking-tight">
                    MyLibrary
                </h1>

                <p class="text-[#CFEDEE] leading-relaxed mb-8">
                    Sistem perpustakaan digital modern yang memudahkan
                    peminjaman buku, manajemen riwayat, dan ulasan
                    dengan pengalaman yang clean dan profesional.
                </p>

                {{-- <div class="space-y-4 text-sm text-[#B8E1E6]">

                    <!-- Peminjaman Online -->
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-[#7AB2B2]" fill="none" stroke="currentColor" stroke-width="1.8"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M4 19.5A2.5 2.5 0 016.5 17H20M4 4h13a2 2 0 012 2v13M4 4v15.5A2.5 2.5 0 006.5 22H20" />
                        </svg>
                        <span>Peminjaman Online</span>
                    </div>

                    <!-- Rating & Ulasan -->
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-[#7AB2B2]" fill="none" stroke="currentColor" stroke-width="1.8"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l2.072 6.363a1 1 0 00.95.69h6.69c.969 0 1.371 1.24.588 1.81l-5.414 3.936a1 1 0 00-.364 1.118l2.072 6.363c.3.921-.755 1.688-1.54 1.118l-5.414-3.936a1 1 0 00-1.176 0l-5.414 3.936c-.784.57-1.838-.197-1.539-1.118l2.072-6.363a1 1 0 00-.364-1.118L.349 11.79c-.783-.57-.38-1.81.588-1.81h6.69a1 1 0 00.95-.69l2.072-6.363z" />
                        </svg>
                        <span>Rating & Ulasan</span>
                    </div>

                    <!-- Monitoring Status -->
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-[#7AB2B2]" fill="none" stroke="currentColor" stroke-width="1.8"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 17v-6h13M9 11V5h13M3 21V3" />
                        </svg>
                        <span>Monitoring Status Otomatis</span>
                    </div>

                </div> --}}
            </div>

            <!-- RIGHT: LOGIN FORM -->
            <div class="p-10 flex items-center">
                <div class="w-full">

                    <h2 class="text-2xl font-semibold text-[#09637E] mb-2">
                        Masuk ke Akun
                    </h2>
                    <p class="text-gray-500 text-sm mb-8">
                        Silakan masuk untuk mengakses dashboard Anda.
                    </p>

                    @if (session('status'))
                    <div class="mb-4 p-3 rounded-xl bg-[#7AB2B2]/20 text-[#09637E] text-sm">
                        {{ session('status') }}
                    </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}" class="space-y-5">
                        @csrf

                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">
                                Email
                            </label>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                                autocomplete="username" class="w-full rounded-xl border border-[#7AB2B2] px-4 py-3
                                       focus:outline-none focus:ring-2 focus:ring-[#088395]
                                       focus:border-[#088395] transition">
                            @error('email')
                            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">
                                Password
                            </label>
                            <input id="password" type="password" name="password" required
                                autocomplete="current-password" class="w-full rounded-xl border border-[#7AB2B2] px-4 py-3
                                       focus:outline-none focus:ring-2 focus:ring-[#088395]
                                       focus:border-[#088395] transition">
                            @error('password')
                            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Button -->
                        <button type="submit" class="w-full bg-[#088395] hover:bg-[#09637E]
                                       text-white py-3 rounded-xl font-medium
                                       transition shadow-md">
                            Login
                        </button>

                             <div class="text-center text-sm text-gray-600">
                            Belum punya akun?
                            <a href="{{ route('register') }}"
                               class="text-[#088395] hover:text-[#09637E] font-medium transition">
                                Daftar di sini
                            </a>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>

</body>

</html>
