<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-[#09637E] leading-tight">
            Profil Saya
        </h2>
    </x-slot>

    <div class="py-10 bg-[#EBF4F6] min-h-screen">
        <div class="max-w-5xl mx-auto px-6">

            <div class="bg-white rounded-3xl shadow-md border border-[#7AB2B2]/30 p-8">

                <div class="flex justify-between items-center mb-8">
                    <h1 class="text-2xl font-bold text-[#09637E]">
                        Informasi Akun
                    </h1>

                    <div class="flex gap-3">
                        <a href="{{ route('profil-petugas.edit') }}"
                           class="bg-[#088395] hover:bg-[#09637E] text-white px-5 py-2 rounded-2xl transition">
                            Edit Profil
                        </a>
                    </div>
                </div>

                @if(session('success'))
                    <div class="mb-6 p-4 rounded-xl bg-green-100 text-green-700 text-sm">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="grid md:grid-cols-2 gap-8">

                    <div>
                        <p class="text-sm text-gray-500">Nama</p>
                        <p class="text-lg font-semibold text-gray-800">
                            {{ $user->nama }}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500">Username</p>
                        <p class="text-lg font-semibold text-gray-800">
                            {{ $user->username }}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500">Email</p>
                        <p class="text-lg font-semibold text-gray-800">
                            {{ $user->email }}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500">Nomor Telepon</p>
                        <p class="text-lg font-semibold text-gray-800">
                            {{ $user->profil->nomor_telepon ?? '-' }}
                        </p>
                    </div>

                    <div class="md:col-span-2">
                        <p class="text-sm text-gray-500">Alamat</p>
                        <p class="text-lg font-semibold text-gray-800">
                            {{ $user->profil->alamat ?? '-' }}
                        </p>
                    </div>

                </div>

            </div>

        </div>
    </div>
</x-app-layout>
