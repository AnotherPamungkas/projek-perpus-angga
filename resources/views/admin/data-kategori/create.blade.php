<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-[#3D3D3B] leading-tight">
            Tambah Kategori
        </h2>
    </x-slot>

    <div class="min-h-screen bg-[#F4F4F2] py-8">
        <div class="max-w-3xl mx-auto px-6">

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

            <div class="bg-[#E8E8E8] border border-[#BBBFCA] rounded-3xl shadow-sm overflow-hidden">

                {{-- Header --}}
                <div class="px-8 py-6 border-b border-[#BBBFCA] bg-[#F4F4F2]">
                    <h3 class="text-xl font-bold text-[#3D3D3B]">
                        Form Tambah Kategori
                    </h3>

                    <p class="text-sm text-[#3D3D3B]/60 mt-1">
                        Tambahkan kategori baru ke sistem perpustakaan.
                    </p>
                </div>

                {{-- Form --}}
                <form action="{{ route('admin.data-kategori.store') }}"
                      method="POST"
                      class="p-8">

                    @csrf

                    <div class="space-y-6">

                        {{-- Nama Kategori --}}
                        <div>
                            <label class="block text-sm font-medium text-[#3D3D3B] mb-2">
                                Nama Kategori
                            </label>

                            <input type="text"
                                   name="nama_kategori"
                                   value="{{ old('nama_kategori') }}"
                                   placeholder="Masukkan nama kategori"
                                   class="w-full rounded-2xl border border-[#BBBFCA] bg-white px-4 py-3
                                   focus:ring-2 focus:ring-[#3D3D3B]"
                                   required>
                        </div>

                    </div>

                    {{-- Action --}}
                    <div class="flex justify-end gap-3 mt-8 pt-6 border-t border-[#BBBFCA]">

                        <a href="{{ route('admin.data-kategori.index') }}"
                           class="px-5 py-3 rounded-2xl border border-[#BBBFCA]
                           text-[#3D3D3B] hover:bg-[#F4F4F2] transition">
                            Kembali
                        </a>

                        <button type="submit"
                                class="px-6 py-3 rounded-2xl bg-[#3D3D3B]
                                text-white hover:opacity-90 transition">
                            Simpan Kategori
                        </button>

                    </div>

                </form>

            </div>

        </div>
    </div>
</x-app-layout>
