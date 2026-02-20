<x-app-layout>
    <x-slot name="header">
        Tambah Kategori
    </x-slot>

    <div class="py-8">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-xl rounded-2xl p-6">

                <form action="{{ route('admin.data-kategori.store') }}" method="POST">
                    @csrf

                    <div class="mb-5">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Nama Kategori
                        </label>
                        <input type="text"
                               name="nama_kategori"
                               class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-[#088395] focus:outline-none"
                               placeholder="Masukkan nama kategori"
                               required>
                    </div>

                    <div class="flex justify-end gap-3">
                        <a href="{{ route('admin.data-kategori.index') }}"
                           class="px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white rounded-lg transition">
                            Kembali
                        </a>

                        <button class="px-5 py-2 bg-[#09637E] hover:bg-[#088395] text-white rounded-lg shadow transition">
                            Simpan
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</x-app-layout>
