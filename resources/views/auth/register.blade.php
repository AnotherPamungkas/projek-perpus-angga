<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Perpustakaan Digital</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen flex items-center
    bg-gradient-to-br from-[#eaf2ff] via-white to-[#d6e6ff]">

    <div class="max-w-5xl mx-auto w-full px-6">
        <div class="grid md:grid-cols-2 bg-white rounded-3xl shadow-xl overflow-hidden border border-blue-100">

            <!-- LEFT SIDE (Branding) -->
            <div class="bg-gradient-to-br from-[#1557b0] via-[#1a73e8] to-[#4da3ff]
                text-white p-10 flex flex-col justify-center">

                <h1 class="text-4xl font-bold mb-4 tracking-tight">
                    Bergabung dengan Perpustakaan Digital
                </h1>

                <p class="text-blue-100 leading-relaxed mb-8">
                    Daftar untuk mulai mengakses koleksi buku digital,
                    melakukan peminjaman, serta menikmati pengalaman
                    perpustakaan modern yang cepat dan efisien.
                </p>

            </div>

            <!-- RIGHT SIDE (Register Form) -->
            <div class="p-8 sm:p-10 flex items-center">
                <div class="w-full max-w-md mx-auto">

                    <h2 class="text-2xl font-semibold text-[#1557b0] mb-2">
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
                                class="w-full rounded-xl border border-gray-200 px-4 py-3 text-sm
                                focus:outline-none focus:ring-2 focus:ring-[#1a73e8]
                                focus:border-[#1a73e8] transition">
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
                                class="w-full rounded-xl border border-gray-200 px-4 py-3 text-sm
                                focus:outline-none focus:ring-2 focus:ring-[#1a73e8]
                                focus:border-[#1a73e8] transition">
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
                                class="w-full rounded-xl border border-gray-200 px-4 py-3 text-sm
                                focus:outline-none focus:ring-2 focus:ring-[#1a73e8]
                                focus:border-[#1a73e8] transition">
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
                                class="w-full rounded-xl border border-gray-200 px-4 py-3 text-sm
                                focus:outline-none focus:ring-2 focus:ring-[#1a73e8]
                                focus:border-[#1a73e8] transition">
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
                                class="w-full rounded-xl border border-gray-200 px-4 py-3 text-sm
                                focus:outline-none focus:ring-2 focus:ring-[#1a73e8]
                                focus:border-[#1a73e8] transition">
                            @error('password_confirmation')
                                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Submit -->
                        <button type="submit"
                            class="w-full py-3 rounded-xl text-white font-medium
                            bg-gradient-to-r from-[#1557b0] to-[#1a73e8]
                            hover:from-[#144a96] hover:to-[#1666cc]
                            transition shadow-md">
                            Register
                        </button>

                        <!-- Login link -->
                        <div class="text-center text-sm text-gray-600">
                            Sudah punya akun?
                            <a href="{{ route('login') }}"
                                class="text-[#1a73e8] hover:text-[#1557b0] font-medium transition">
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
