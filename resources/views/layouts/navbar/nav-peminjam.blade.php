<nav x-data="{ open: false }" class="bg-white shadow-sm border-b border-[#7AB2B2]/30">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">

            <!-- Left -->
            <div class="flex items-center space-x-10">

                <a href="{{ route('peminjam.dashboard') }}" class="text-xl font-bold text-[#09637E] tracking-wide">
                    MyLibrary
                </a>

                <div class="hidden sm:flex space-x-8 text-sm font-medium">

                    <a href="{{ route('peminjam.dashboard') }}"
                        class="hover:text-[#088395] transition {{ request()->routeIs('peminjam.dashboard') ? 'text-[#09637E] border-b-2 border-[#09637E]' : 'text-gray-600' }}">
                        Dashboard
                    </a>

                    <a href="{{ route('peminjam.buku.index') }}" class="hover:text-[#088395] transition text-gray-600">
                        Katalog Buku
                    </a>

                    <a href="{{ route('peminjam.riwayat-peminjaman.index') }}"
                        class="hover:text-[#088395] transition text-gray-600">
                        Riwayat
                    </a>

                    <a href="{{ route('profil-peminjam.index') }}"
                        class="hover:text-[#088395] transition text-gray-600">
                        Profil
                    </a>

                </div>
            </div>

            <!-- User Dropdown -->
            <div class="hidden md:block relative mt-5" x-data="{ userOpen: false }">

                <button @click="userOpen = !userOpen"
                    class="flex items-center gap-2 text-[#09637E] text-sm hover:text-[#088395] transition">

                    <span>{{ Auth::user()->nama }}</span>

                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transition-transform"
                        :class="{ 'rotate-180': userOpen }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>

                <!-- Dropdown Panel -->
                <div x-show="userOpen" x-transition @click.away="userOpen = false"
                    class="absolute right-0 mt-3 w-44 bg-white rounded-xl shadow-xl overflow-hidden z-50 border border-[#7AB2B2]/30">

                    <a href="{{ route('profil-peminjam.index') }}"
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

        </div>
    </div>
</nav>
