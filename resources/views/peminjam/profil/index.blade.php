<x-app-layout>
    <div class="min-h-screen py-8" style="background-color: #f0f4f8;">
        <div class="max-w-5xl mx-auto px-6 space-y-6">

            <div class="bg-white rounded-2xl shadow-sm overflow-hidden">

                {{-- HEADER --}}
                <div class="px-8 py-5 flex items-center justify-between"
                    style="background: linear-gradient(135deg, #1557b0 0%, #1a73e8 55%, #4da3ff 100%);">

                    <div>
                        <h1 class="text-white font-bold text-lg tracking-wide">Profil Saya</h1>
                        <p class="text-white/70 text-xs mt-0.5">Informasi akun dan data diri kamu</p>
                    </div>

                    <a href="{{ route('profil-peminjam.edit') }}"
                        class="flex items-center gap-2 px-4 py-2 rounded-xl text-sm font-semibold bg-white/20 text-white hover:bg-white/30 border border-white/30 transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        Edit Profil
                    </a>

                </div>

                {{-- BODY --}}
                <div class="p-8">
                    <div class="grid md:grid-cols-2 gap-6">

                        <div class="bg-gray-50 rounded-xl px-5 py-4 border border-gray-100">
                            <p class="text-xs text-gray-400 font-medium">Nama</p>
                            <p class="text-base font-bold text-gray-800 mt-1">{{ $user->nama }}</p>
                        </div>

                        <div class="bg-gray-50 rounded-xl px-5 py-4 border border-gray-100">
                            <p class="text-xs text-gray-400 font-medium">Username</p>
                            <p class="text-base font-bold text-gray-800 mt-1">{{ $user->username }}</p>
                        </div>

                        <div class="bg-gray-50 rounded-xl px-5 py-4 border border-gray-100">
                            <p class="text-xs text-gray-400 font-medium">Email</p>
                            <p class="text-base font-bold text-gray-800 mt-1">{{ $user->email }}</p>
                        </div>

                        <div class="bg-gray-50 rounded-xl px-5 py-4 border border-gray-100">
                            <p class="text-xs text-gray-400 font-medium">Nomor Telepon</p>
                            <p class="text-base font-bold text-gray-800 mt-1">
                                {{ $user->profil->nomor_telepon ?? '-' }}
                            </p>
                        </div>

                        <div class="md:col-span-2 bg-gray-50 rounded-xl px-5 py-4 border border-gray-100">
                            <p class="text-xs text-gray-400 font-medium">Alamat</p>
                            <p class="text-base font-bold text-gray-800 mt-1">
                                {{ $user->profil->alamat ?? '-' }}
                            </p>
                        </div>

                    </div>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>
