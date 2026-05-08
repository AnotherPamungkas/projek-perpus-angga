<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-[#3D3D3B] leading-tight">
            Edit Buku
        </h2>
    </x-slot>

    <div class="min-h-screen bg-[#F4F4F2] py-8">
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

            <div class="bg-[#E8E8E8] border border-[#BBBFCA] rounded-3xl shadow-sm overflow-hidden">

                {{-- Header --}}
                <div class="px-8 py-6 border-b border-[#BBBFCA] bg-[#F4F4F2]">
                    <h3 class="text-xl font-bold text-[#3D3D3B]">
                        Form Edit Buku
                    </h3>
                    <p class="text-sm text-[#3D3D3B]/60 mt-1">
                        Perbarui data buku sesuai kebutuhan.
                    </p>
                </div>

                {{-- Form --}}
                <form action="{{ route('petugas.data-buku.update', $buku->id) }}"
                      method="POST"
                      enctype="multipart/form-data"
                      class="p-8">

                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        {{-- Judul Buku --}}
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-[#3D3D3B] mb-2">
                                Judul Buku
                            </label>
                            <input type="text"
                                   name="judul_buku"
                                   value="{{ old('judul_buku', $buku->judul_buku) }}"
                                   class="w-full rounded-2xl border border-[#BBBFCA] bg-white px-4 py-3 focus:ring-2 focus:ring-[#3D3D3B] focus:border-[#3D3D3B]"
                                   required>
                        </div>

                        {{-- Pengarang --}}
                        <div>
                            <label class="block text-sm font-medium text-[#3D3D3B] mb-2">
                                Pengarang
                            </label>
                            <input type="text"
                                   name="pengarang"
                                   value="{{ old('pengarang', $buku->pengarang) }}"
                                   class="w-full rounded-2xl border border-[#BBBFCA] bg-white px-4 py-3 focus:ring-2 focus:ring-[#3D3D3B]"
                                   required>
                        </div>

                        {{-- Penerbit --}}
                        <div>
                            <label class="block text-sm font-medium text-[#3D3D3B] mb-2">
                                Penerbit
                            </label>
                            <input type="text"
                                   name="penerbit"
                                   value="{{ old('penerbit', $buku->penerbit) }}"
                                   class="w-full rounded-2xl border border-[#BBBFCA] bg-white px-4 py-3 focus:ring-2 focus:ring-[#3D3D3B]"
                                   required>
                        </div>

                        {{-- Tahun Terbit --}}
                        <div>
                            <label class="block text-sm font-medium text-[#3D3D3B] mb-2">
                                Tahun Terbit
                            </label>
                            <input type="text"
                                   name="tahun_terbit"
                                   value="{{ old('tahun_terbit', $buku->tahun_terbit) }}"
                                   class="w-full rounded-2xl border border-[#BBBFCA] bg-white px-4 py-3 focus:ring-2 focus:ring-[#3D3D3B]"
                                   required>
                        </div>

                        {{-- Kategori --}}
                        <div>
                            <label class="block text-sm font-medium text-[#3D3D3B] mb-2">
                                Kategori
                            </label>
                            <select name="kategori_id"
                                    class="w-full rounded-2xl border border-[#BBBFCA] bg-white px-4 py-3 focus:ring-2 focus:ring-[#3D3D3B]"
                                    required>
                                @foreach($kategori as $item)
                                    <option value="{{ $item->id }}"
                                        {{ $buku->kategori_id == $item->id ? 'selected' : '' }}>
                                        {{ $item->nama_kategori }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Jumlah Buku --}}
                        <div>
                            <label class="block text-sm font-medium text-[#3D3D3B] mb-2">
                                Jumlah Buku
                            </label>
                            <input type="number"
                                   name="jumlah_buku"
                                   min="1"
                                   value="{{ old('jumlah_buku', $buku->jumlah_buku) }}"
                                   class="w-full rounded-2xl border border-[#BBBFCA] bg-white px-4 py-3 focus:ring-2 focus:ring-[#3D3D3B]"
                                   required>
                        </div>

                        {{-- Deskripsi --}}
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-[#3D3D3B] mb-2">
                                Deskripsi
                            </label>
                            <textarea name="deskripsi"
                                      rows="4"
                                      class="w-full rounded-2xl border border-[#BBBFCA] bg-white px-4 py-3 focus:ring-2 focus:ring-[#3D3D3B]">{{ old('deskripsi', $buku->deskripsi) }}</textarea>
                        </div>

                        {{-- Cover Buku --}}
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-[#3D3D3B] mb-2">
                                Cover Buku
                            </label>

                            @if($buku->cover)
                                <div class="mb-4">
                                    <img src="{{ asset('storage/cover-buku/' . $buku->cover) }}"
                                         class="w-40 h-56 object-cover rounded-2xl border border-[#BBBFCA] shadow-sm">
                                </div>
                            @endif

                            <input type="file"
                                   name="cover"
                                   accept="image/*"
                                   class="w-full rounded-2xl border border-[#BBBFCA] bg-white px-4 py-3">

                            <p class="text-xs text-[#3D3D3B]/60 mt-2">
                                Kosongkan jika tidak ingin mengganti cover.
                            </p>
                        </div>

                    </div>

                    {{-- Action Button --}}
                    <div class="flex justify-end gap-3 mt-8 pt-6 border-t border-[#BBBFCA]">

                        <a href="{{ route('petugas.data-buku.index') }}"
                           class="px-5 py-3 rounded-2xl border border-[#BBBFCA] text-[#3D3D3B] hover:bg-[#F4F4F2] transition">
                            Kembali
                        </a>

                        <button type="submit"
                                class="px-6 py-3 rounded-2xl bg-[#3D3D3B] text-white hover:opacity-90 transition">
                            Update Buku
                        </button>

                    </div>

                </form>

            </div>
        </div>
    </div>
</x-app-layout>
