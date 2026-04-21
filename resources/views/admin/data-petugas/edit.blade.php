<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-[#1557b0]">
            Edit Petugas
        </h2>
    </x-slot>

    <div class="py-8 min-h-screen bg-gradient-to-br from-[#eaf2ff] via-white to-[#d6e6ff]">
        <div class="max-w-3xl mx-auto px-6">

            <div class="bg-white rounded-3xl shadow-sm border border-blue-100 overflow-hidden">

                <!-- Header -->
                <div class="px-8 py-6 border-b border-blue-100">
                    <h3 class="text-lg font-semibold text-[#1557b0]">
                        Edit Data Petugas
                    </h3>
                    <p class="text-sm text-gray-500 mt-1">
                        Perbarui informasi petugas sesuai kebutuhan.
                    </p>
                </div>

                <!-- Form -->
                <form action="{{ route('admin.data-petugas.update', $petugas->id) }}" method="POST" class="p-8 space-y-6">
                    @csrf
                    @method('PUT')

                    <div class="grid md:grid-cols-2 gap-6">

                        <!-- Nama -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Nama Lengkap
                            </label>
                            <input type="text" name="nama" value="{{ $petugas->nama }}" required
                                class="w-full rounded-xl border border-gray-200 px-4 py-3 text-sm
                                focus:ring-2 focus:ring-[#1a73e8] focus:border-[#1a73e8]">
                        </div>

                        <!-- Username -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Username
                            </label>
                            <input type="text" name="username" value="{{ $petugas->username }}" required
                                class="w-full rounded-xl border border-gray-200 px-4 py-3 text-sm
                                focus:ring-2 focus:ring-[#1a73e8] focus:border-[#1a73e8]">
                        </div>

                        <!-- Email -->
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Email
                            </label>
                            <input type="email" name="email" value="{{ $petugas->email }}" required
                                class="w-full rounded-xl border border-gray-200 px-4 py-3 text-sm
                                focus:ring-2 focus:ring-[#1a73e8] focus:border-[#1a73e8]">
                        </div>

                        <!-- Password -->
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Password
                                <span class="text-xs text-gray-400">(Kosongkan jika tidak diubah)</span>
                            </label>
                            <input type="password" name="password"
                                class="w-full rounded-xl border border-gray-200 px-4 py-3 text-sm
                                focus:ring-2 focus:ring-[#1a73e8] focus:border-[#1a73e8]">
                        </div>

                    </div>

                    <!-- Actions -->
                    <div class="flex justify-end gap-3 pt-4 border-t border-gray-100">

                        <a href="{{ route('admin.data-petugas.index') }}"
                           class="px-5 py-2.5 rounded-xl text-sm border border-gray-300 text-gray-600 hover:bg-gray-50 transition">
                            Kembali
                        </a>

                        <button type="submit"
                            class="px-6 py-2.5 rounded-xl text-white text-sm
                            bg-gradient-to-r from-[#1557b0] to-[#1a73e8]
                            hover:from-[#144a96] hover:to-[#1666cc] transition shadow-sm">
                            Update
                        </button>

                    </div>

                </form>
            </div>

        </div>
    </div>
</x-app-layout>
