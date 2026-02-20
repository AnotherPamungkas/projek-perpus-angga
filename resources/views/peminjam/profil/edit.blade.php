<x-app-layout>
    <div class="py-10 bg-[#EBF4F6] min-h-screen">
        <div class="max-w-5xl mx-auto px-6">

            <div class="bg-white rounded-3xl shadow-md border border-[#7AB2B2]/30 p-8">

                <h1 class="text-2xl font-bold text-[#09637E] mb-8">
                    Edit Profil
                </h1>

                <form method="POST" action="{{ route('profil-peminjam.update') }}" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div class="grid md:grid-cols-2 gap-6">

                        <div>
                            <label class="block text-sm text-gray-600 mb-1">Nama</label>
                            <input type="text" name="nama"
                                   value="{{ old('nama', $user->nama) }}"
                                   class="w-full rounded-2xl border border-[#7AB2B2]/40 focus:ring-2 focus:ring-[#7AB2B2] focus:border-[#088395] px-4 py-2">
                        </div>

                        <div>
                            <label class="block text-sm text-gray-600 mb-1">Username</label>
                            <input type="text" name="username"
                                   value="{{ old('username', $user->username) }}"
                                   class="w-full rounded-2xl border border-[#7AB2B2]/40 focus:ring-2 focus:ring-[#7AB2B2] focus:border-[#088395] px-4 py-2">
                        </div>

                        <div>
                            <label class="block text-sm text-gray-600 mb-1">Email</label>
                            <input type="email" name="email"
                                   value="{{ old('email', $user->email) }}"
                                   class="w-full rounded-2xl border border-[#7AB2B2]/40 focus:ring-2 focus:ring-[#7AB2B2] focus:border-[#088395] px-4 py-2">
                        </div>

                        <div>
                            <label class="block text-sm text-gray-600 mb-1">Nomor Telepon</label>
                            <input type="text" name="nomor_telepon"
                                   value="{{ old('nomor_telepon', $user->profil->nomor_telepon ?? '') }}"
                                   class="w-full rounded-2xl border border-[#7AB2B2]/40 focus:ring-2 focus:ring-[#7AB2B2] focus:border-[#088395] px-4 py-2">
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-sm text-gray-600 mb-1">Alamat</label>
                            <textarea name="alamat"
                                class="w-full rounded-2xl border border-[#7AB2B2]/40 focus:ring-2 focus:ring-[#7AB2B2] focus:border-[#088395] px-4 py-2"
                                rows="3">{{ old('alamat', $user->profil->alamat ?? '') }}</textarea>
                        </div>

                    </div>

                    <div class="flex justify-end gap-4 pt-6">
                        <a href="{{ route('profil-peminjam.index') }}"
                           class="px-5 py-2 rounded-2xl border border-gray-300 text-gray-600 hover:bg-gray-100">
                            Batal
                        </a>

                        <button type="submit"
                            class="bg-[#088395] hover:bg-[#09637E] text-white px-6 py-2 rounded-2xl transition">
                            Simpan Perubahan
                        </button>
                    </div>

                </form>

            </div>

        </div>
    </div>
</x-app-layout>
