<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Kategori
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white p-6 shadow rounded">
                <form action="{{ route('admin.data-kategori.update', $kategori->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block mb-1">Nama Kategori</label>
                        <input type="text"
                               name="nama_kategori"
                               class="w-full border rounded px-3 py-2"
                               value="{{ $kategori->nama_kategori }}"
                               required>
                    </div>

                    <div class="flex justify-end space-x-2">
                        <a href="{{ route('admin.data-kategori.index') }}"
                           class="px-4 py-2 bg-gray-500 text-white rounded">
                            Kembali
                        </a>
                        <button class="px-4 py-2 bg-green-600 text-white rounded">
                            Update
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>
