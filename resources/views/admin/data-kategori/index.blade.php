<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

            {{-- Title --}}
            <div>
                <h2 class="text-xl font-bold text-[#1F1F1E]">
                    Manajemen Data Kategori
                </h2>
                <p class="text-sm text-gray-500 mt-1">
                    Kelola kategori buku yang tersedia di perpustakaan.
                </p>
            </div>

        </div>
    </x-slot>

    <div class="py-8 bg-[#F7F7F5] min-h-screen">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Alert Success --}}
            @if(session('success'))
                <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-2xl shadow-sm">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Summary --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                {{-- Total Kategori --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
                    <p class="text-sm text-gray-500">
                        Total Kategori
                    </p>

                    <h3 class="text-2xl font-bold text-[#1F1F1E] mt-2">
                        {{ $kategori->count() }}
                    </h3>
                </div>

                {{-- Action Section --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 flex items-center justify-between">

                    <div>
                        <p class="text-sm text-gray-500">
                            Kelola Data
                        </p>

                        <p class="text-sm text-[#1F1F1E] mt-1">
                            Tambahkan kategori buku baru
                        </p>
                    </div>

                    <a href="{{ route('admin.data-kategori.create') }}"
                       class="px-5 py-2.5 rounded-xl
                              bg-[#3D3D3B] hover:bg-[#2A2A28]
                              text-white text-sm font-medium
                              shadow-sm transition">
                        + Tambah
                    </a>

                </div>

            </div>

            {{-- Main Card --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">

                {{-- Top Section --}}
                <div class="px-6 py-5 border-b border-gray-100">

                    <div>
                        <h3 class="font-semibold text-[#1F1F1E]">
                            Daftar Data Kategori
                        </h3>

                        <p class="text-sm text-gray-500 mt-1">
                            Semua kategori buku yang tersedia di sistem.
                        </p>
                    </div>

                </div>

                {{-- Table --}}
                <div class="overflow-x-auto">

                    <table class="min-w-full text-sm text-left">

                        <thead class="bg-[#1F1F1E] text-white">
                            <tr>
                                <th class="px-6 py-4 font-medium">
                                    No
                                </th>

                                <th class="px-6 py-4 font-medium">
                                    Nama Kategori
                                </th>

                                <th class="px-6 py-4 font-medium text-center">
                                    Jumlah Buku
                                </th>

                                <th class="px-6 py-4 font-medium text-center">
                                    Aksi
                                </th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-100">

                            @forelse($kategori as $item)

                                <tr class="hover:bg-gray-50 transition">

                                    {{-- No --}}
                                    <td class="px-6 py-5 text-gray-600">
                                        {{ $loop->iteration }}
                                    </td>

                                    {{-- Nama Kategori --}}
                                    <td class="px-6 py-5">
                                        <span class="font-semibold text-[#1F1F1E]">
                                            {{ $item->nama_kategori }}
                                        </span>
                                    </td>

                                    {{-- Jumlah Buku --}}
                                    <td class="px-6 py-5 text-center">

                                        <span class="inline-flex items-center
                                                     px-3 py-1 rounded-full
                                                     bg-[#F4F4F2]
                                                     text-[#1F1F1E]
                                                     text-xs font-medium">
                                            {{ $item->buku_count }} Buku
                                        </span>

                                    </td>

                                    {{-- Aksi --}}
                                    <td class="px-6 py-5 text-center">

                                        <div class="flex justify-center gap-2">

                                            {{-- Edit --}}
                                            <a href="{{ route('admin.data-kategori.edit', $item->id) }}"
                                               class="px-4 py-2 rounded-xl
                                                      bg-[#3D3D3B] hover:bg-[#2A2A28]
                                                      text-white text-xs font-medium
                                                      transition shadow-sm">
                                                Edit
                                            </a>

                                            {{-- Delete --}}
                                            @if($item->buku_count > 0)

                                                <button disabled
                                                        title="Kategori sedang digunakan"
                                                        class="px-4 py-2 rounded-xl
                                                               bg-gray-300 cursor-not-allowed
                                                               text-gray-500 text-xs font-medium">
                                                    Hapus
                                                </button>

                                            @else

                                                <form action="{{ route('admin.data-kategori.destroy', $item->id) }}"
                                                      method="POST"
                                                      onsubmit="return confirm('Yakin hapus kategori ini?')">

                                                    @csrf
                                                    @method('DELETE')

                                                    <button
                                                        class="px-4 py-2 rounded-xl
                                                               bg-red-500 hover:bg-red-600
                                                               text-white text-xs font-medium
                                                               transition shadow-sm">
                                                        Hapus
                                                    </button>

                                                </form>

                                            @endif

                                        </div>

                                    </td>

                                </tr>

                            @empty

                                <tr>
                                    <td colspan="4" class="py-16 text-center">

                                        <div class="flex flex-col items-center gap-2">

                                            <div class="w-14 h-14 rounded-full bg-gray-100 flex items-center justify-center">
                                                📂
                                            </div>

                                            <p class="text-gray-500 font-medium">
                                                Data kategori masih kosong
                                            </p>

                                        </div>

                                    </td>
                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>
</x-app-layout>
