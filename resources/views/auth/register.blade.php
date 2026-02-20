<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - MyLibrary</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#EBF4F6] min-h-screen flex items-center">

    <div class="max-w-5xl mx-auto w-full px-6">
        <div class="grid md:grid-cols-2 bg-white rounded-3xl shadow-xl overflow-hidden border border-[#7AB2B2]/30">

            <!-- LEFT SIDE (Branding) -->
            <div class="bg-[#09637E] text-white p-10 flex flex-col justify-center">
                <h1 class="text-4xl font-bold mb-4 tracking-tight">
                    Bergabung dengan MyLibrary
                </h1>

                <p class="text-[#CFEDEE] leading-relaxed mb-8">
                    Daftar untuk mulai mengakses koleksi buku digital,
                    melakukan peminjaman, serta memberikan ulasan
                    dalam sistem perpustakaan modern.
                </p>

                {{-- <div class="space-y-4 text-sm text-[#B8E1E6]">

                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-[#7AB2B2]" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M4 19.5A2.5 2.5 0 016.5 17H20M4 4h13a2 2 0 012 2v13"/>
                        </svg>
                        <span>Akses Koleksi Digital</span>
                    </div>

                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-[#7AB2B2]" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M5 13l4 4L19 7"/>
                        </svg>
                        <span>Monitoring Status Peminjaman</span>
                    </div>

                 <div class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-[#7AB2B2]" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l2.072 6.363"/>
                        </svg>
                        <span>Sistem Ulasan Terintegrasi</span>
                    </div>
                </div> --}}
            </div>

            <!-- RIGHT SIDE (Register Form) -->
            <div class="p-10 flex items-center">
                <div class="w-full max-w-md mx-auto">

                    <h2 class="text-2xl font-semibold text-[#09637E] mb-2">
                        Buat Akun Baru
                    </h2>
                    <p class="text-gray-500 text-sm mb-8">
                        Lengkapi data berikut untuk mendaftar.
                    </p>

                    <form method="POST" action="{{ route('register') }}" class="space-y-5">
                        @csrf

                        <!-- Nama -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Nama Lengkap
                            </label>
                            <input type="text" name="nama" value="{{ old('nama') }}" required
                                class="w-full rounded-xl border border-[#7AB2B2] px-4 py-3
                                       focus:outline-none focus:ring-2 focus:ring-[#088395]
                                       focus:border-[#088395] transition">
                            @error('nama')
                                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Username -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Username
                            </label>
                            <input type="text" name="username" value="{{ old('username') }}" required
                                class="w-full rounded-xl border border-[#7AB2B2] px-4 py-3
                                       focus:outline-none focus:ring-2 focus:ring-[#088395]
                                       focus:border-[#088395] transition">
                            @error('username')
                                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Email
                            </label>
                            <input type="email" name="email" value="{{ old('email') }}" required
                                class="w-full rounded-xl border border-[#7AB2B2] px-4 py-3
                                       focus:outline-none focus:ring-2 focus:ring-[#088395]
                                       focus:border-[#088395] transition">
                            @error('email')
                                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Password
                            </label>
                            <input type="password" name="password" required
                                class="w-full rounded-xl border border-[#7AB2B2] px-4 py-3
                                       focus:outline-none focus:ring-2 focus:ring-[#088395]
                                       focus:border-[#088395] transition">
                            @error('password')
                                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Confirm Password -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Konfirmasi Password
                            </label>
                            <input type="password" name="password_confirmation" required
                                class="w-full rounded-xl border border-[#7AB2B2] px-4 py-3
                                       focus:outline-none focus:ring-2 focus:ring-[#088395]
                                       focus:border-[#088395] transition">
                            @error('password_confirmation')
                                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Submit -->
                        <button type="submit"
                            class="w-full bg-[#088395] hover:bg-[#09637E]
                                   text-white py-3 rounded-xl font-medium
                                   transition shadow-md">
                            Register
                        </button>

                        <!-- Login link -->
                        <div class="text-center text-sm text-gray-600">
                            Sudah punya akun?
                            <a href="{{ route('login') }}"
                               class="text-[#088395] hover:text-[#09637E] font-medium transition">
                                Login di sini
                            </a>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>

</body>
</html>
