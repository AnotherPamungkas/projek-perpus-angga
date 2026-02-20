<nav x-data="{ open: false }" class="bg-[#09637E] shadow-lg">

    <div class="max-w-7xl mx-auto px-6">
        <div class="flex justify-between items-center h-16">

            <!-- Logo -->
            <div class="flex items-center space-x-3">
                <span class="text-white text-lg font-bold tracking-wide">
                    MyLibrary
                </span>
            </div>

            <!-- Desktop Menu -->
            <div class="hidden md:flex items-center space-x-8 text-sm font-medium">

                <a href="{{ route('admin.dashboard') }}"
                   class="text-white/90 hover:text-white transition">
                    Dashboard
                </a>

                <a href="{{ route('admin.data-peminjam.index') }}"
                   class="text-white/90 hover:text-white transition">
                    Data Peminjam
                </a>

                <a href="{{ route('admin.data-petugas.index') }}"
                   class="text-white/90 hover:text-white transition">
                    Data Petugas
                </a>

                <a href="{{ route('admin.data-kategori.index') }}"
                   class="text-white/90 hover:text-white transition">
                    Data Kategori
                </a>

                <a href="{{ route('admin.data-buku.index') }}"
                   class="text-white/90 hover:text-white transition">
                    Data Buku
                </a>

                <a href="{{ route('admin.data-ulasan.index') }}"
                   class="text-white/90 hover:text-white transition">
                    Data Ulasan
                </a>

                <a href="{{ route('admin.riwayat-peminjaman') }}"
                   class="text-white/90 hover:text-white transition">
                    Riwayat Peminjaman
                </a>

            </div>

            <!-- User Dropdown -->
            <div class="hidden md:block relative" x-data="{ userOpen: false }">

                <button @click="userOpen = !userOpen"
                        class="flex items-center gap-2 text-white text-sm hover:text-white/80 transition">

                    <span>{{ Auth::user()->name }}</span>

                    <!-- Arrow -->
                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="h-4 w-4 transition-transform"
                         :class="{ 'rotate-180': userOpen }"
                         fill="none" viewBox="0 0 24 24"
                         stroke="currentColor">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M19 9l-7 7-7-7" />
                    </svg>
                </button>

                <!-- Dropdown -->
                <div x-show="userOpen"
                     x-transition
                     @click.away="userOpen = false"
                     class="absolute right-0 mt-3 w-44 bg-white rounded-xl shadow-xl overflow-hidden z-50">

                       <a href="{{ route('profil-admin.index') }}"
                        class="block px-4 py-3 text-sm text-gray-700 hover:bg-[#EBF4F6] transition">
                        Profil Saya
                    </a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                                class="w-full text-left px-4 py-3 text-sm text-red-600 hover:bg-red-50 transition">
                            Logout
                        </button>
                    </form>

                </div>

            </div>

            <!-- Mobile -->
            <button @click="open = !open" class="md:hidden text-white">
                ☰
            </button>

        </div>
    </div>

    <!-- Mobile Menu -->
    <div x-show="open"
         class="md:hidden bg-[#088395] px-6 py-4 space-y-3 text-white text-sm">

        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
        <a href="{{ route('admin.data-peminjam.index') }}">Data Peminjam</a>
        <a href="{{ route('admin.data-petugas.index') }}">Data Petugas</a>
        <a href="{{ route('admin.data-kategori.index') }}">Data Kategori</a>
        <a href="{{ route('admin.data-buku.index') }}">Data Buku</a>
        <a href="{{ route('admin.data-ulasan.index') }}">Data Ulasan</a>
        <a href="{{ route('admin.riwayat-peminjaman') }}">Riwayat Peminjaman</a>

        <div class="pt-4 border-t border-white/20">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="text-red-200">
                    Logout
                </button>
            </form>
        </div>

    </div>

</nav>
