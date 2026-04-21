<div class="relative flex items-center justify-between h-16 px-6 bg-white border-b border-blue-100 shadow-sm">

    <!-- LEFT: NAVIGASI -->
    <div class="flex items-center space-x-10">
        <div class="hidden sm:flex space-x-8 text-sm font-medium">

            <a href="{{ route('peminjam.dashboard') }}"
                class="relative pb-1 transition
                {{ request()->routeIs('peminjam.dashboard')
                    ? 'text-[#1a73e8] after:absolute after:left-0 after:-bottom-1 after:w-full after:h-[2px] after:bg-[#1a73e8]'
                    : 'text-gray-600 hover:text-[#1a73e8]' }}">
                Dashboard
            </a>

            <a href="{{ route('peminjam.buku.index') }}"
                class="relative pb-1 transition
                {{ request()->routeIs('peminjam.buku.*')
                    ? 'text-[#1a73e8] after:absolute after:left-0 after:-bottom-1 after:w-full after:h-[2px] after:bg-[#1a73e8]'
                    : 'text-gray-600 hover:text-[#1a73e8]' }}">
                Katalog Buku
            </a>

            <a href="{{ route('peminjam.riwayat-peminjaman.index') }}"
                class="relative pb-1 transition
                {{ request()->routeIs('peminjam.riwayat-peminjaman.*')
                    ? 'text-[#1a73e8] after:absolute after:left-0 after:-bottom-1 after:w-full after:h-[2px] after:bg-[#1a73e8]'
                    : 'text-gray-600 hover:text-[#1a73e8]' }}">
                Riwayat
            </a>

            <a href="{{ route('profil-peminjam.index') }}"
                class="relative pb-1 transition
                {{ request()->routeIs('profil-peminjam.*')
                    ? 'text-[#1a73e8] after:absolute after:left-0 after:-bottom-1 after:w-full after:h-[2px] after:bg-[#1a73e8]'
                    : 'text-gray-600 hover:text-[#1a73e8]' }}">
                Profil
            </a>

        </div>
    </div>

    <!-- CENTER: JUDUL -->
    <div class="absolute left-1/2 transform -translate-x-1/2">
        <h1 class="inline-block whitespace-nowrap overflow-hidden border-r-2 border-[#1a73e8]
        text-xl font-extrabold
        bg-gradient-to-r from-[#1557b0] via-[#1a73e8] to-[#4da3ff]
        text-transparent bg-clip-text
        leading-none
        animate-typing">
            Perpustakaan Digital
        </h1>
    </div>

    <!-- RIGHT: DROPDOWN -->
    <div class="hidden md:block relative" x-data="{ userOpen: false }">
        <button @click="userOpen = !userOpen"
            class="flex items-center gap-2 text-[#1557b0] text-sm font-medium hover:text-[#1a73e8] transition">

            <span>{{ Auth::user()->nama }}</span>

            <svg xmlns="http://www.w3.org/2000/svg"
                class="h-4 w-4 transition-transform"
                :class="{ 'rotate-180': userOpen }"
                fill="none" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                    stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
        </button>

        <!-- Dropdown -->
        <div x-show="userOpen" x-transition @click.away="userOpen = false"
            class="absolute right-0 mt-3 w-44 bg-white rounded-xl shadow-lg overflow-hidden z-50 border border-blue-100">

            <a href="{{ route('profil-peminjam.index') }}"
                class="block px-4 py-3 text-sm text-gray-700 hover:bg-blue-50 transition">
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

</div>
