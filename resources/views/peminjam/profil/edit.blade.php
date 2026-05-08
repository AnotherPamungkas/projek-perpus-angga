<x-app-layout>
    <div class="min-h-screen py-8 bg-[#F4F4F2]">
        <div class="max-w-5xl mx-auto px-6 space-y-6">

            {{-- Main Card --}}
            <div class="bg-white rounded-3xl shadow-sm overflow-hidden border border-[#E7E5E4]">

                {{-- HEADER --}}
                <div class="px-8 py-6 bg-[#3D3D3B] flex items-center justify-between">

                    <a href="{{ route('profil-peminjam.index') }}"
                        class="flex items-center gap-2 text-gray-300 hover:text-white transition text-sm font-semibold">

                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="w-4 h-4"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="2.5">
                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M15 19l-7-7 7-7" />
                        </svg>

                        Kembali
                    </a>

                    <div class="text-center">
                        <h1 class="text-white font-bold text-xl tracking-wide">
                            Edit Profil
                        </h1>
                        <p class="text-gray-300 text-sm mt-1">
                            Perbarui data pribadi Anda
                        </p>
                    </div>

                    <div class="w-16"></div>

                </div>

                {{-- BODY --}}
                <div class="p-8">

                    <form method="POST"
                        action="{{ route('profil-peminjam.update') }}"
                        class="space-y-6">

                        @csrf
                        @method('PUT')

                        {{-- Form Section --}}
                        <div class="grid md:grid-cols-2 gap-6">

                            {{-- Nama --}}
                            <div>
                                <label class="block text-sm font-semibold text-[#3D3D3B] mb-2">
                                    Nama
                                </label>
                                <input type="text"
                                    name="nama"
                                    value="{{ old('nama', $user->nama) }}"
                                    class="w-full rounded-2xl border border-[#D6D3D1] bg-[#FAFAF9] px-4 py-3 text-sm focus:ring-2 focus:ring-[#3D3D3B] focus:outline-none focus:bg-white transition">
                            </div>

                            {{-- Username --}}
                            <div>
                                <label class="block text-sm font-semibold text-[#3D3D3B] mb-2">
                                    Username
                                </label>
                                <input type="text"
                                    name="username"
                                    value="{{ old('username', $user->username) }}"
                                    class="w-full rounded-2xl border border-[#D6D3D1] bg-[#FAFAF9] px-4 py-3 text-sm focus:ring-2 focus:ring-[#3D3D3B] focus:outline-none focus:bg-white transition">
                            </div>

                            {{-- Email --}}
                            <div>
                                <label class="block text-sm font-semibold text-[#3D3D3B] mb-2">
                                    Email
                                </label>
                                <input type="email"
                                    name="email"
                                    value="{{ old('email', $user->email) }}"
                                    class="w-full rounded-2xl border border-[#D6D3D1] bg-[#FAFAF9] px-4 py-3 text-sm focus:ring-2 focus:ring-[#3D3D3B] focus:outline-none focus:bg-white transition">
                            </div>

                            {{-- Nomor Telepon --}}
                            <div>
                                <label class="block text-sm font-semibold text-[#3D3D3B] mb-2">
                                    Nomor Telepon
                                </label>
                                <input type="text"
                                    name="nomor_telepon"
                                    value="{{ old('nomor_telepon', $user->profil->nomor_telepon ?? '') }}"
                                    class="w-full rounded-2xl border border-[#D6D3D1] bg-[#FAFAF9] px-4 py-3 text-sm focus:ring-2 focus:ring-[#3D3D3B] focus:outline-none focus:bg-white transition">
                            </div>

                            {{-- Alamat --}}
                            <div class="md:col-span-2">
                                <label class="block text-sm font-semibold text-[#3D3D3B] mb-2">
                                    Alamat
                                </label>
                                <textarea name="alamat"
                                    rows="4"
                                    class="w-full rounded-2xl border border-[#D6D3D1] bg-[#FAFAF9] px-4 py-3 text-sm focus:ring-2 focus:ring-[#3D3D3B] focus:outline-none focus:bg-white transition">{{ old('alamat', $user->profil->alamat ?? '') }}</textarea>
                            </div>

                        </div>

                        {{-- Footer Action --}}
                        <div class="flex justify-end gap-3 pt-6 border-t border-[#E7E5E4]">

                            <a href="{{ route('profil-peminjam.index') }}"
                                class="px-5 py-3 rounded-2xl border border-[#D6D3D1] text-sm font-semibold text-gray-600 hover:bg-[#FAFAF9] transition">
                                Batal
                            </a>

                            <button type="submit"
                                class="flex items-center gap-2 px-6 py-3 rounded-2xl text-sm font-semibold text-white bg-[#3D3D3B] hover:bg-[#2F2F2E] transition shadow-sm">

                                <svg class="w-4 h-4"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>

                                Simpan Perubahan
                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>
    </div>
</x-app-layout>
