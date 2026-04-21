<x-app-layout>
    <div class="min-h-screen py-8" style="background-color: #f0f4f8;">
        <div class="max-w-5xl mx-auto px-6 space-y-6">

            <div class="bg-white rounded-2xl shadow-sm overflow-hidden">

                {{-- HEADER --}}
                <div class="px-8 py-5 flex items-center justify-between"
                    style="background: linear-gradient(135deg, #1557b0 0%, #1a73e8 55%, #4da3ff 100%);">

                    <a href="{{ route('profil-peminjam.index') }}"
                        class="flex items-center gap-2 text-white/90 hover:text-white transition group text-sm font-semibold">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="w-4 h-4 group-hover:-translate-x-1 transition-transform duration-200"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                        </svg>
                        Kembali
                    </a>

                    <div class="text-center">
                        <h1 class="text-white font-bold text-lg tracking-wide">Edit Profil</h1>
                        <p class="text-white/70 text-xs mt-0.5">Perbarui informasi akun kamu</p>
                    </div>

                    <div class="w-16"></div>

                </div>

                {{-- BODY --}}
                <div class="p-8">
                    <form method="POST" action="{{ route('profil-peminjam.update') }}" class="space-y-5">
                        @csrf
                        @method('PUT')

                        <div class="grid md:grid-cols-2 gap-5">

                            <div>
                                <label class="block text-xs font-semibold text-gray-500 mb-1.5">Nama</label>
                                <input type="text" name="nama"
                                    value="{{ old('nama', $user->nama) }}"
                                    class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-2.5 text-sm focus:ring-2 focus:ring-[#1a73e8] focus:outline-none focus:bg-white transition">
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-gray-500 mb-1.5">Username</label>
                                <input type="text" name="username"
                                    value="{{ old('username', $user->username) }}"
                                    class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-2.5 text-sm focus:ring-2 focus:ring-[#1a73e8] focus:outline-none focus:bg-white transition">
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-gray-500 mb-1.5">Email</label>
                                <input type="email" name="email"
                                    value="{{ old('email', $user->email) }}"
                                    class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-2.5 text-sm focus:ring-2 focus:ring-[#1a73e8] focus:outline-none focus:bg-white transition">
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-gray-500 mb-1.5">Nomor Telepon</label>
                                <input type="text" name="nomor_telepon"
                                    value="{{ old('nomor_telepon', $user->profil->nomor_telepon ?? '') }}"
                                    class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-2.5 text-sm focus:ring-2 focus:ring-[#1a73e8] focus:outline-none focus:bg-white transition">
                            </div>

                            <div class="md:col-span-2">
                                <label class="block text-xs font-semibold text-gray-500 mb-1.5">Alamat</label>
                                <textarea name="alamat" rows="3"
                                    class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-2.5 text-sm focus:ring-2 focus:ring-[#1a73e8] focus:outline-none focus:bg-white transition">{{ old('alamat', $user->profil->alamat ?? '') }}</textarea>
                            </div>

                        </div>

                        <div class="flex justify-end gap-3 pt-2 border-t border-gray-100">
                            <a href="{{ route('profil-peminjam.index') }}"
                                class="px-5 py-2.5 rounded-xl border border-gray-200 text-sm font-semibold text-gray-600 hover:bg-gray-50 transition">
                                Batal
                            </a>
                            <button type="submit"
                                class="flex items-center gap-2 px-6 py-2.5 rounded-xl text-sm font-semibold text-white shadow-sm transition hover:opacity-90"
                                style="background: linear-gradient(135deg, #1557b0 0%, #1a73e8 55%, #4da3ff 100%);">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
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
