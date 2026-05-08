<x-app-layout>
    <div class="py-8 bg-[#F4F4F2] min-h-screen">
        <div class="max-w-4xl mx-auto px-6">

            {{-- Error Alert --}}
            @if ($errors->any())
                <div class="mb-6 bg-red-50 border border-red-200 rounded-2xl p-4 shadow-sm">
                    <p class="font-semibold text-red-600 mb-2">
                        Terjadi kesalahan:
                    </p>

                    <ul class="text-sm text-red-500 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>- {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white rounded-3xl shadow-sm border border-gray-200 overflow-hidden">

                {{-- Header --}}
                <div class="px-8 py-6 border-b border-gray-100">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-800">
                            Edit Profil
                        </h1>
                        <p class="text-sm text-gray-500 mt-1">
                            Perbarui informasi akun administrator
                        </p>
                    </div>
                </div>

                {{-- Form --}}
                <div class="p-8">
                    <form method="POST"
                          action="{{ route('profil-admin.update') }}"
                          class="space-y-8">

                        @csrf
                        @method('PUT')

                        <div class="grid md:grid-cols-2 gap-6">

                            {{-- Nama --}}
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    Nama
                                </label>
                                <input type="text"
                                       name="nama"
                                       value="{{ old('nama', $user->nama) }}"
                                       class="w-full rounded-2xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm
                                              focus:ring-2 focus:ring-zinc-800
                                              focus:border-zinc-800
                                              focus:bg-white transition">
                            </div>

                            {{-- Username --}}
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    Username
                                </label>
                                <input type="text"
                                       name="username"
                                       value="{{ old('username', $user->username) }}"
                                       class="w-full rounded-2xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm
                                              focus:ring-2 focus:ring-zinc-800
                                              focus:border-zinc-800
                                              focus:bg-white transition">
                            </div>

                            {{-- Email --}}
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    Email
                                </label>
                                <input type="email"
                                       name="email"
                                       value="{{ old('email', $user->email) }}"
                                       class="w-full rounded-2xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm
                                              focus:ring-2 focus:ring-zinc-800
                                              focus:border-zinc-800
                                              focus:bg-white transition">
                            </div>

                            {{-- Nomor Telepon --}}
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    Nomor Telepon
                                </label>
                                <input type="text"
                                       name="nomor_telepon"
                                       value="{{ old('nomor_telepon', $user->profil->nomor_telepon ?? '') }}"
                                       class="w-full rounded-2xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm
                                              focus:ring-2 focus:ring-zinc-800
                                              focus:border-zinc-800
                                              focus:bg-white transition">
                            </div>

                            {{-- Alamat --}}
                            <div class="md:col-span-2">
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    Alamat
                                </label>
                                <textarea
                                    name="alamat"
                                    rows="4"
                                    class="w-full rounded-2xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm
                                           focus:ring-2 focus:ring-zinc-800
                                           focus:border-zinc-800
                                           focus:bg-white transition">{{ old('alamat', $user->profil->alamat ?? '') }}</textarea>
                            </div>

                        </div>

                        {{-- Action --}}
                        <div class="flex justify-end gap-4 pt-6 border-t border-gray-100">

                            <a href="{{ route('profil-admin.index') }}"
                               class="px-5 py-3 rounded-2xl bg-gray-200 text-gray-700 text-sm font-semibold hover:bg-gray-300 transition">
                                Batal
                            </a>

                            <button type="submit"
                                    class="px-6 py-3 rounded-2xl bg-zinc-800 text-white text-sm font-semibold hover:bg-zinc-700 transition shadow-sm">
                                Simpan Perubahan
                            </button>

                        </div>

                    </form>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>
