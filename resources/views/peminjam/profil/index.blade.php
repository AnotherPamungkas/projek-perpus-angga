<x-app-layout>
    <div class="min-h-screen py-8 bg-[#F4F4F2]">
        <div class="max-w-5xl mx-auto px-6 space-y-6">

            {{-- Main Card --}}
            <div class="bg-white rounded-3xl shadow-sm overflow-hidden border border-[#E7E5E4]">

                {{-- HEADER --}}
                <div class="px-8 py-6 bg-[#3D3D3B] flex items-center justify-between">

                    <div>
                        <h1 class="text-white font-bold text-xl tracking-wide">
                            Profil Saya
                        </h1>
                        <p class="text-gray-300 text-sm mt-1">
                            Informasi akun dan data pribadi
                        </p>
                    </div>

                    <a href="{{ route('profil-peminjam.edit') }}"
                        class="flex items-center gap-2 px-4 py-2.5 rounded-xl text-sm font-semibold bg-white text-[#3D3D3B] hover:bg-[#F4F4F2] transition">

                        <svg class="w-4 h-4" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>

                        Edit Profil
                    </a>

                </div>

                {{-- BODY --}}
                <div class="p-8">

                    {{-- Avatar --}}
                    <div class="flex flex-col items-center mb-8">

                        <div
                            class="w-24 h-24 rounded-full bg-[#3D3D3B] flex items-center justify-center text-white text-3xl font-bold shadow-sm">
                            {{ strtoupper(substr($user->nama, 0, 1)) }}
                        </div>

                        <h2 class="mt-4 text-xl font-bold text-[#3D3D3B]">
                            {{ $user->nama }}
                        </h2>

                        <p class="text-sm text-gray-500">
                            {{ $user->email }}
                        </p>

                    </div>

                    {{-- Detail Profile --}}
                    <div class="grid md:grid-cols-2 gap-6">

                        <div class="bg-[#FAFAF9] rounded-2xl px-5 py-4 border border-[#E7E5E4]">
                            <p class="text-xs text-gray-500 font-medium">Nama Lengkap</p>
                            <p class="text-base font-bold text-[#3D3D3B] mt-2">
                                {{ $user->nama }}
                            </p>
                        </div>

                        <div class="bg-[#FAFAF9] rounded-2xl px-5 py-4 border border-[#E7E5E4]">
                            <p class="text-xs text-gray-500 font-medium">Username</p>
                            <p class="text-base font-bold text-[#3D3D3B] mt-2">
                                {{ $user->username }}
                            </p>
                        </div>

                        <div class="bg-[#FAFAF9] rounded-2xl px-5 py-4 border border-[#E7E5E4]">
                            <p class="text-xs text-gray-500 font-medium">Email</p>
                            <p class="text-base font-bold text-[#3D3D3B] mt-2">
                                {{ $user->email }}
                            </p>
                        </div>

                        <div class="bg-[#FAFAF9] rounded-2xl px-5 py-4 border border-[#E7E5E4]">
                            <p class="text-xs text-gray-500 font-medium">Nomor Telepon</p>
                            <p class="text-base font-bold text-[#3D3D3B] mt-2">
                                {{ $user->profil->nomor_telepon ?? '-' }}
                            </p>
                        </div>

                        <div class="md:col-span-2 bg-[#FAFAF9] rounded-2xl px-5 py-4 border border-[#E7E5E4]">
                            <p class="text-xs text-gray-500 font-medium">Alamat</p>
                            <p class="text-base font-bold text-[#3D3D3B] mt-2 leading-relaxed">
                                {{ $user->profil->alamat ?? '-' }}
                            </p>
                        </div>

                    </div>

                </div>

            </div>

        </div>
    </div>
</x-app-layout>
