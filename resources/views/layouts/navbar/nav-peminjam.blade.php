<div class="relative flex items-center justify-between h-16 px-6 bg-[#F4F4F2] border-b border-[#BBBFCA] shadow-sm">

    <!-- LEFT: NAVIGASI -->
    <div class="flex items-center space-x-10">
        <div class="hidden sm:flex space-x-8 text-sm font-medium">

            {{-- Dashboard --}}
            <a href="{{ route('peminjam.dashboard') }}"
                class="relative pb-1 transition-all duration-300
                {{ request()->routeIs('peminjam.dashboard')
                    ? 'text-[#3D3D3B] after:absolute after:left-0 after:-bottom-1 after:w-full after:h-[2px] after:bg-[#3D3D3B]'
                    : 'text-[#3D3D3B]/70 hover:text-[#3D3D3B]' }}">
                Dashboard
            </a>

            {{-- Katalog Buku --}}
            <a href="{{ route('peminjam.buku.index') }}"
                class="relative pb-1 transition-all duration-300
                {{ request()->routeIs('peminjam.buku.*')
                    ? 'text-[#3D3D3B] after:absolute after:left-0 after:-bottom-1 after:w-full after:h-[2px] after:bg-[#3D3D3B]'
                    : 'text-[#3D3D3B]/70 hover:text-[#3D3D3B]' }}">
                Katalog Buku
            </a>

            {{-- Riwayat --}}
            <a href="{{ route('peminjam.riwayat-peminjaman.index') }}"
                class="relative pb-1 transition-all duration-300
                {{ request()->routeIs('peminjam.riwayat-peminjaman.*')
                    ? 'text-[#3D3D3B] after:absolute after:left-0 after:-bottom-1 after:w-full after:h-[2px] after:bg-[#3D3D3B]'
                    : 'text-[#3D3D3B]/70 hover:text-[#3D3D3B]' }}">
                Riwayat
            </a>

            {{-- Profil --}}
            <a href="{{ route('profil-peminjam.index') }}"
                class="relative pb-1 transition-all duration-300
                {{ request()->routeIs('profil-peminjam.*')
                    ? 'text-[#3D3D3B] after:absolute after:left-0 after:-bottom-1 after:w-full after:h-[2px] after:bg-[#3D3D3B]'
                    : 'text-[#3D3D3B]/70 hover:text-[#3D3D3B]' }}">
                Profil
            </a>

        </div>
    </div>

    <!-- CENTER: JUDUL -->
    <div class="absolute left-1/2 transform -translate-x-1/2">
        <h1 class="inline-block whitespace-nowrap overflow-hidden border-r-2 border-[#BBBFCA]
        text-xl font-extrabold
        text-[#3D3D3B]
        leading-none
        animate-typing">
            BliblioTech
        </h1>
    </div>

    <!-- RIGHT: DROPDOWN -->
    <div class="hidden md:block relative" x-data="{ userOpen: false }">

        <button @click="userOpen = !userOpen"
            class="flex items-center gap-2 text-[#3D3D3B] text-sm font-medium hover:opacity-80 transition-all duration-300">

            <span>{{ Auth::user()->nama }}</span>

            <svg xmlns="http://www.w3.org/2000/svg"
                class="h-4 w-4 transition-transform duration-300"
                :class="{ 'rotate-180': userOpen }"
                fill="none"
                viewBox="0 0 24 24">

                <path stroke="currentColor"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M19 9l-7 7-7-7" />
            </svg>

        </button>

        <!-- Dropdown -->
        <div x-show="userOpen"
            x-transition
            @click.away="userOpen = false"
            class="absolute right-0 mt-3 w-44 bg-[#E8E8E8] rounded-xl shadow-lg overflow-hidden z-50 border border-[#BBBFCA]">

            {{-- Profil --}}
            <a href="{{ route('profil-peminjam.index') }}"
                class="block px-4 py-3 text-sm text-[#3D3D3B] hover:bg-[#F4F4F2] transition-all duration-300">
                Profil Saya
            </a>

            {{-- Logout --}}
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="w-full text-left px-4 py-3 text-sm text-red-500 hover:bg-red-50 transition-all duration-300">
                    Logout
                </button>
            </form>

        </div>

    </div>

</div>
