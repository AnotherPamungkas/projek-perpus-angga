<nav x-data="{ open: false }" class="bg-[#1F1F1E] shadow-sm border-b border-[#2A2A28] sticky top-0 z-50">

    <div class="max-w-7xl mx-auto px-6">
        <div class="flex justify-between items-center h-16">

            {{-- Logo --}}
            <div class="flex items-center gap-3">

                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2">

                    <div class="w-9 h-9 rounded-xl bg-[#3D3D3B] flex items-center justify-center">
                        <span class="text-white font-bold text-sm">
                            B
                        </span>
                    </div>

                    <span class="text-white text-lg font-bold tracking-wide">
                        BiblioTech
                    </span>

                </a>

            </div>

            {{-- Desktop Menu --}}
            <div class="hidden md:flex items-center space-x-8 text-sm font-medium">

                {{-- Dashboard --}}
                <a href="{{ route('admin.dashboard') }}" class="relative pb-1 transition duration-200
                    {{ request()->routeIs('admin.dashboard')
                        ? 'text-white after:absolute after:left-0 after:-bottom-1 after:w-full after:h-[2px] after:bg-white'
                        : 'text-[#D6D3D1] hover:text-white' }}">
                    Dashboard
                </a>

                {{-- Peminjam --}}
                <a href="{{ route('admin.data-peminjam.index') }}" class="relative pb-1 transition duration-200
                    {{ request()->routeIs('admin.data-peminjam.*')
                        ? 'text-white after:absolute after:left-0 after:-bottom-1 after:w-full after:h-[2px] after:bg-white'
                        : 'text-[#D6D3D1] hover:text-white' }}">
                    Data Peminjam
                </a>

                {{-- Petugas --}}
                <a href="{{ route('admin.data-petugas.index') }}" class="relative pb-1 transition duration-200
                    {{ request()->routeIs('admin.data-petugas.*')
                        ? 'text-white after:absolute after:left-0 after:-bottom-1 after:w-full after:h-[2px] after:bg-white'
                        : 'text-[#D6D3D1] hover:text-white' }}">
                    Data Petugas
                </a>

                {{-- Kategori --}}
                <a href="{{ route('admin.data-kategori.index') }}" class="relative pb-1 transition duration-200
                    {{ request()->routeIs('admin.data-kategori.*')
                        ? 'text-white after:absolute after:left-0 after:-bottom-1 after:w-full after:h-[2px] after:bg-white'
                        : 'text-[#D6D3D1] hover:text-white' }}">
                    Data Kategori
                </a>

                {{-- Verifikasi Buku --}}
                <a href="{{ route('admin.verifikasi-buku.index') }}" class="relative pb-1 transition duration-200
                    {{ request()->routeIs('admin.verifikasi-buku.*')
                        ? 'text-white after:absolute after:left-0 after:-bottom-1 after:w-full after:h-[2px] after:bg-white'
                        : 'text-[#D6D3D1] hover:text-white' }}">
                    Verifikasi Buku
                </a>

                {{-- Buku --}}
                <a href="{{ route('admin.data-buku.index') }}" class="relative pb-1 transition duration-200
                    {{ request()->routeIs('admin.data-buku.*')
                        ? 'text-white after:absolute after:left-0 after:-bottom-1 after:w-full after:h-[2px] after:bg-white'
                        : 'text-[#D6D3D1] hover:text-white' }}">
                    Data Buku
                </a>

                {{-- Ulasan --}}
                <a href="{{ route('admin.data-ulasan.index') }}" class="relative pb-1 transition duration-200
                    {{ request()->routeIs('admin.data-ulasan.*')
                        ? 'text-white after:absolute after:left-0 after:-bottom-1 after:w-full after:h-[2px] after:bg-white'
                        : 'text-[#D6D3D1] hover:text-white' }}">
                    Ulasan
                </a>

                {{-- Riwayat --}}
                <a href="{{ route('admin.riwayat-peminjaman') }}" class="relative pb-1 transition duration-200
                    {{ request()->routeIs('admin.riwayat-peminjaman')
                        ? 'text-white after:absolute after:left-0 after:-bottom-1 after:w-full after:h-[2px] after:bg-white'
                        : 'text-[#D6D3D1] hover:text-white' }}">
                    Riwayat
                </a>

            </div>

            {{-- User Dropdown --}}
            <div class="hidden md:block relative" x-data="{ userOpen: false }">

                <button @click="userOpen = !userOpen"
                    class="flex items-center gap-3 px-3 py-2 rounded-xl hover:bg-[#2C2C2B] transition">

                    <div class="w-8 h-8 rounded-full bg-[#3D3D3B] flex items-center justify-center">
                        <span class="text-white text-sm font-semibold">
                            {{ strtoupper(substr(Auth::user()->nama, 0, 1)) }}
                        </span>
                    </div>

                    <span class="text-white text-sm font-medium">
                        Admin
                    </span>

                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white transition-transform"
                        :class="{ 'rotate-180': userOpen }" fill="none" viewBox="0 0 24 24" stroke="currentColor">

                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />

                    </svg>

                </button>

                {{-- Dropdown --}}
                <div x-show="userOpen" x-transition @click.away="userOpen = false"
                    class="absolute right-0 mt-3 w-52 bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100 z-50">

                    <div class="px-4 py-3 border-b border-gray-100">
                        <p class="font-semibold text-gray-800 text-sm">
                            {{ Auth::user()->nama }}
                        </p>
                        <p class="text-xs text-gray-400">
                            Administrator
                        </p>
                    </div>

                    <a href="{{ route('profil-admin.index') }}"
                        class="block px-4 py-3 text-sm text-gray-700 hover:bg-gray-50 transition">
                        Profil Saya
                    </a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <button type="submit"
                            class="w-full text-left px-4 py-3 text-sm text-red-500 hover:bg-red-50 transition">
                            Logout
                        </button>

                    </form>

                </div>

            </div>

            {{-- Mobile Button --}}
            <button @click="open = !open" class="md:hidden text-white">

                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">

                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />

                </svg>

            </button>

        </div>
    </div>

    {{-- Mobile Menu --}}
    <div x-show="open" x-transition class="md:hidden bg-[#2A2A28] border-t border-[#3D3D3B] px-6 py-4 space-y-2">

        <a href="{{ route('admin.dashboard') }}"
            class="block text-[#D6D3D1] px-3 py-2 rounded-xl hover:bg-[#3D3D3B] hover:text-white transition">
            Dashboard
        </a>

        <a href="{{ route('admin.data-peminjam.index') }}"
            class="block text-[#D6D3D1] px-3 py-2 rounded-xl hover:bg-[#3D3D3B] hover:text-white transition">
            Data Peminjam
        </a>

        <a href="{{ route('admin.data-petugas.index') }}"
            class="block text-[#D6D3D1] px-3 py-2 rounded-xl hover:bg-[#3D3D3B] hover:text-white transition">
            Data Petugas
        </a>

        <a href="{{ route('admin.data-kategori.index') }}"
            class="block text-[#D6D3D1] px-3 py-2 rounded-xl hover:bg-[#3D3D3B] hover:text-white transition">
            Data Kategori
        </a>

        <a href="{{ route('admin.data-buku.index') }}"
            class="block text-[#D6D3D1] px-3 py-2 rounded-xl hover:bg-[#3D3D3B] hover:text-white transition">
            Data Buku
        </a>

        <a href="{{ route('admin.data-ulasan.index') }}"
            class="block text-[#D6D3D1] px-3 py-2 rounded-xl hover:bg-[#3D3D3B] hover:text-white transition">
            Data Ulasan
        </a>

        <a href="{{ route('admin.riwayat-peminjaman') }}"
            class="block text-[#D6D3D1] px-3 py-2 rounded-xl hover:bg-[#3D3D3B] hover:text-white transition">
            Riwayat
        </a>

        <div class="pt-4 border-t border-[#3D3D3B]">

            <a href="{{ route('profil-admin.index') }}"
                class="block text-[#D6D3D1] px-3 py-2 rounded-xl hover:bg-[#3D3D3B] hover:text-white transition">
                Profil Saya
            </a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button type="submit"
                    class="w-full text-left px-3 py-2 rounded-xl text-red-400 hover:bg-red-500/10 transition">
                    Logout
                </button>

            </form>

        </div>

    </div>

</nav>
