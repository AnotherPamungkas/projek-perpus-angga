<x-app-layout>
    <x-slot name="header">
        <div class="bg-[#3D3D3B] rounded-2xl px-8 py-6 shadow-sm">
            <h1 class="text-2xl font-bold text-white">
                Edit Kategori
            </h1>
            <p class="text-sm text-[#D6D3D1] mt-1">
                Perbarui data kategori buku
            </p>
        </div>
    </x-slot>

    <div class="py-8 bg-[#F5F5F4] min-h-screen">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-sm rounded-2xl border border-[#E7E5E4] p-8">

                <form action="{{ route('petugas.data-kategori.update', $kategori->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-6">

                        <label class="block text-sm font-semibold text-[#1F1F1E] mb-2">
                            Nama Kategori
                        </label>

                        <input type="text"
                            name="nama_kategori"
                            value="{{ $kategori->nama_kategori }}"
                            class="w-full rounded-xl border border-[#E7E5E4] bg-[#F9F9F8] px-4 py-3 focus:ring-2 focus:ring-[#3D3D3B] focus:outline-none"
                            required>

                    </div>

                    <div class="flex justify-end gap-3 pt-4 border-t border-[#E7E5E4]">

                        <a href="{{ route('petugas.data-kategori.index') }}"
                            class="px-5 py-2.5 rounded-xl border border-[#E7E5E4] text-[#3D3D3B] hover:bg-[#F9F9F8] transition">
                            Kembali
                        </a>

                        <button
                            class="px-6 py-2.5 rounded-xl bg-[#1F1F1E] hover:bg-[#3D3D3B] text-white transition">
                            Update
                        </button>

                    </div>

                </form>

            </div>

        </div>
    </div>
</x-app-layout>
