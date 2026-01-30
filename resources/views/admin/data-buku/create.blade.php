<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tambah Buku
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white p-6 shadow rounded">
                <form action="{{ route('admin.data-buku.store') }}"
                      method="POST"
                      enctype="multipart/form-data">
                    @csrf

                    <div class="mb-4">
                        <label class="block mb-1">Judul Buku</label>
                        <input type="text" name="judul_buku"
                               class="w-full border rounded px-3 py-2"
                               required>
                    </div>

                    <div class="mb-4">
                        <label class="block mb-1">Pengarang</label>
                        <input type="text" name="pengarang"
                               class="w-full border rounded px-3 py-2"
                               required>
                    </div>

                    <div class="mb-4">
                        <label class="block mb-1">Penerbit</label>
                        <input type="text" name="penerbit"
                               class="w-full border rounded px-3 py-2"
                               required>
                    </div>

                    <div class="mb-4">
                        <label class="block mb-1">Tahun Terbit</label>
                        <input type="text" name="tahun_terbit"
                               class="w-full border rounded px-3 py-2"
                               placeholder="Contoh: 2024"
                               required>
                    </div>

                    <div class="mb-4">
                        <label class="block mb-1">Kategori</label>
                        <select name="kategori_id"
                                class="w-full border rounded px-3 py-2"
                                required>
                            <option value="">-- Pilih Kategori --</option>
                            @foreach($kategori as $item)
                                <option value="{{ $item->id }}">
                                    {{ $item->nama_kategori }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block mb-1">Jumlah Buku</label>
                        <input type="number" name="jumlah_buku"
                               class="w-full border rounded px-3 py-2"
                               min="1"
                               required>
                    </div>

                    <div class="mb-4">
                        <label class="block mb-1">Deskripsi</label>
                        <textarea name="deskripsi"
                                  class="w-full border rounded px-3 py-2"
                                  rows="3"></textarea>
                    </div>

                    <div class="mb-4">
                        <label class="block mb-1">Cover Buku</label>
                        <input type="file" name="cover"
                               class="w-full border rounded px-3 py-2"
                               accept="image/*">
                        <p class="text-sm text-gray-500 mt-1">
                            JPG / PNG (max 2MB)
                        </p>
                    </div>

                    <div class="flex justify-end space-x-2">
                        <a href="{{ route('admin.data-buku.index') }}"
                           class="px-4 py-2 bg-gray-500 text-white rounded">
                            Kembali
                        </a>
                        <button class="px-4 py-2 bg-green-600 text-white rounded">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>
