<x-app-layout>
    <x-slot name="header">
        <div class="bg-zinc-800 rounded-3xl px-8 py-6 shadow-sm border border-zinc-700">
            <h2 class="text-2xl font-bold text-white">
                Profil Saya
            </h2>
            <p class="text-sm text-gray-300 mt-1">
                Informasi akun administrator perpustakaan
            </p>
        </div>
    </x-slot>

    <div class="py-8 bg-[#F4F4F2] min-h-screen">
        <div class="max-w-5xl mx-auto px-6 space-y-6">

            {{-- Success Alert --}}
            @if(session('success'))
                <div class="bg-green-50 border border-green-200 text-green-700 px-5 py-4 rounded-2xl">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Main Card --}}
            <div class="bg-white rounded-3xl shadow-sm border border-gray-200 overflow-hidden">

                {{-- Top Action --}}
                <div class="px-8 py-6 border-b border-gray-100 flex justify-between items-center">
                    <div>
                        <h1 class="text-xl font-bold text-gray-800">
                            Informasi Akun
                        </h1>
                        <p class="text-sm text-gray-500 mt-1">
                            Detail akun dan informasi administrator
                        </p>
                    </div>

                    <a href="{{ route('profil-admin.edit') }}"
                       class="inline-flex items-center gap-2 px-5 py-2.5 rounded-2xl bg-zinc-800 text-white text-sm font-semibold hover:bg-zinc-700 transition">
                        Edit Profil
                    </a>
                </div>

                {{-- Profile Info --}}
                <div class="p-8">
                    <div class="grid md:grid-cols-2 gap-6">

                        {{-- Nama --}}
                        <div class="bg-gray-50 rounded-2xl p-5 border border-gray-100">
                            <p class="text-xs font-medium text-gray-500">
                                Nama Lengkap
                            </p>
                            <p class="text-lg font-bold text-gray-800 mt-2">
                                {{ $user->nama }}
                            </p>
                        </div>

                        {{-- Username --}}
                        <div class="bg-gray-50 rounded-2xl p-5 border border-gray-100">
                            <p class="text-xs font-medium text-gray-500">
                                Username
                            </p>
                            <p class="text-lg font-bold text-gray-800 mt-2">
                                {{ $user->username }}
                            </p>
                        </div>

                        {{-- Email --}}
                        <div class="bg-gray-50 rounded-2xl p-5 border border-gray-100">
                            <p class="text-xs font-medium text-gray-500">
                                Email
                            </p>
                            <p class="text-lg font-bold text-gray-800 mt-2">
                                {{ $user->email }}
                            </p>
                        </div>

                        {{-- Nomor Telepon --}}
                        <div class="bg-gray-50 rounded-2xl p-5 border border-gray-100">
                            <p class="text-xs font-medium text-gray-500">
                                Nomor Telepon
                            </p>
                            <p class="text-lg font-bold text-gray-800 mt-2">
                                {{ $user->profil->nomor_telepon ?? '-' }}
                            </p>
                        </div>

                        {{-- Alamat --}}
                        <div class="md:col-span-2 bg-gray-50 rounded-2xl p-5 border border-gray-100">
                            <p class="text-xs font-medium text-gray-500">
                                Alamat
                            </p>
                            <p class="text-base font-semibold text-gray-800 mt-2 leading-relaxed">
                                {{ $user->profil->alamat ?? '-' }}
                            </p>
                        </div>

                    </div>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>
