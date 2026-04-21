<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Perpustakaan Digital</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen flex items-center
    bg-gradient-to-br from-[#eaf2ff] via-white to-[#d6e6ff]">

    <div class="max-w-5xl mx-auto w-full px-6">
        <div class="grid md:grid-cols-2 bg-white rounded-3xl shadow-xl overflow-hidden border border-blue-100">

            <!-- LEFT: BRANDING -->
            <div class="bg-gradient-to-br from-[#1557b0] via-[#1a73e8] to-[#4da3ff]
                text-white p-10 flex flex-col justify-center">

                <h1 class="text-4xl font-bold mb-4 tracking-tight">
                    Perpustakaan Digital
                </h1>

                <p class="text-blue-100 leading-relaxed mb-8">
                    Sistem perpustakaan digital modern yang memudahkan
                    peminjaman buku, manajemen riwayat, dan pengalaman
                    pengguna yang cepat, bersih, dan efisien.
                </p>

            </div>

            <!-- RIGHT: LOGIN FORM -->
            <div class="p-8 sm:p-10 flex items-center">
                <div class="w-full">

                    <h2 class="text-2xl font-semibold text-[#1557b0] mb-2">
                        Masuk ke Akun
                    </h2>

                    <p class="text-gray-500 text-sm mb-8">
                        Silakan login untuk melanjutkan.
                    </p>

                    @if (session('status'))
                    <div class="mb-4 p-3 rounded-xl bg-blue-50 text-[#1557b0] text-sm">
                        {{ session('status') }}
                    </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}" class="space-y-5">
                        @csrf

                        <!-- Email -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Email
                            </label>

                            <input type="email" name="email" value="{{ old('email') }}" required autofocus
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

                        <!-- Button -->
                        <button type="submit"
                            class="w-full py-3 rounded-xl text-white font-medium
                            bg-gradient-to-r from-[#1557b0] to-[#1a73e8]
                            hover:from-[#144a96] hover:to-[#1666cc]
                            transition shadow-md">
                            Login
                        </button>

                        <!-- Register -->
                        <div class="text-center text-sm text-gray-600">
                            Belum punya akun?
                            <a href="{{ route('register') }}"
                                class="text-[#1a73e8] hover:text-[#1557b0] font-medium transition">
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
