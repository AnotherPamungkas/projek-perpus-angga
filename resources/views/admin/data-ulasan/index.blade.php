<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

            {{-- Title --}}
            <div>
                <h2 class="text-xl font-bold text-[#1F1F1E]">
                    Manajemen Data Ulasan
                </h2>
                <p class="text-sm text-gray-500 mt-1">
                    Kelola seluruh ulasan yang diberikan oleh peminjam.
                </p>
            </div>

        </div>
    </x-slot>

    <div class="py-8 bg-[#F7F7F5] min-h-screen">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Summary Section --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                {{-- Total Ulasan --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
                    <p class="text-sm text-gray-500">
                        Total Ulasan
                    </p>

                    <h3 class="text-2xl font-bold text-[#1F1F1E] mt-2">
                        {{ $ulasan->total() }}
                    </h3>
                </div>

                {{-- Export --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 flex items-center justify-between">

                    <div>
                        <p class="text-sm text-gray-500">
                            Export Data
                        </p>

                        <p class="text-sm text-[#1F1F1E] mt-1">
                            Download seluruh data ulasan dalam format Excel
                        </p>
                    </div>

                    <a href="{{ route('admin.data-ulasan.export') }}"
                        class="px-5 py-2.5 rounded-xl
                               bg-[#3D3D3B] hover:bg-[#2A2A28]
                               text-white text-sm font-medium
                               shadow-sm transition">
                        Export Excel
                    </a>

                </div>

            </div>

            <div x-data="{ openImage: false, imageUrl: '' }">

                {{-- Main Card --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">

                    {{-- Top Section --}}
                    <div class="px-6 py-5 border-b border-gray-100">

                        <div>
                            <h3 class="font-semibold text-[#1F1F1E]">
                                Daftar Ulasan Pengguna
                            </h3>

                            <p class="text-sm text-gray-500 mt-1">
                                Semua ulasan dan rating yang diberikan peminjam.
                            </p>
                        </div>

                    </div>

                    {{-- Table --}}
                    <div class="overflow-x-auto">

                        <table class="min-w-full text-sm text-left">

                            <thead class="bg-[#1F1F1E] text-white">
                                <tr>
                                    <th class="px-6 py-4 font-medium">
                                        Buku
                                    </th>

                                    <th class="px-6 py-4 font-medium">
                                        Peminjam
                                    </th>

                                    <th class="px-6 py-4 font-medium">
                                        Rating
                                    </th>

                                    <th class="px-6 py-4 font-medium">
                                        Ulasan
                                    </th>

                                    <th class="px-6 py-4 font-medium">
                                        Tanggal
                                    </th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-gray-100">

                                @forelse($ulasan as $item)

                                    <tr class="hover:bg-gray-50 transition">

                                        {{-- Buku --}}
                                        <td class="px-6 py-5">

                                            <div class="flex items-center gap-4">

                                                <img src="{{ asset('storage/cover-buku/'.$item->buku->cover) }}"
                                                     class="w-14 h-20 object-cover rounded-xl cursor-pointer
                                                            hover:scale-105 transition shadow-sm"
                                                     @click="imageUrl='{{ asset('storage/cover-buku/'.$item->buku->cover) }}'; openImage=true">

                                                <div>
                                                    <p class="font-semibold text-[#1F1F1E]">
                                                        {{ $item->buku->judul_buku }}
                                                    </p>
                                                </div>

                                            </div>

                                        </td>

                                        {{-- Peminjam --}}
                                        <td class="px-6 py-5">

                                            <div class="flex flex-col">

                                                <span class="font-semibold text-[#1F1F1E]">
                                                    {{ $item->peminjam->nama }}
                                                </span>

                                                <span class="text-sm text-gray-500">
                                                    {{ $item->peminjam->username }}
                                                </span>

                                            </div>

                                        </td>

                                        {{-- Rating --}}
                                        <td class="px-6 py-5">

                                            <span class="inline-flex items-center
                                                         px-3 py-1 rounded-full
                                                         bg-[#F4F4F2]
                                                         text-[#1F1F1E]
                                                         text-xs font-medium">
                                                ⭐ {{ $item->rating }}
                                            </span>

                                        </td>

                                        {{-- Ulasan --}}
                                        <td class="px-6 py-5 max-w-sm">

                                            <p class="text-sm text-gray-700 line-clamp-2">
                                                {{ $item->isi_ulasan }}
                                            </p>

                                        </td>

                                        {{-- Tanggal --}}
                                        <td class="px-6 py-5 text-gray-600">
                                            {{ $item->created_at->format('d M Y') }}
                                        </td>

                                    </tr>

                                @empty

                                    <tr>
                                        <td colspan="5" class="py-16 text-center">

                                            <div class="flex flex-col items-center gap-2">

                                                <div class="w-14 h-14 rounded-full bg-gray-100 flex items-center justify-center">
                                                    ⭐
                                                </div>

                                                <p class="text-gray-500 font-medium">
                                                    Belum ada ulasan tersedia
                                                </p>

                                            </div>

                                        </td>
                                    </tr>

                                @endforelse

                            </tbody>

                        </table>

                    </div>

                </div>

                {{-- Image Modal --}}
                <div x-show="openImage"
                     x-transition.opacity
                     class="fixed inset-0 bg-black/60 flex items-center justify-center z-50">

                    <div class="relative bg-white rounded-2xl p-4 shadow-2xl max-w-md w-full"
                         @click.away="openImage=false">

                        <button @click="openImage=false"
                                class="absolute top-3 right-3 text-gray-500 hover:text-gray-700">
                            ✕
                        </button>

                        <img :src="imageUrl"
                             class="w-full h-auto rounded-xl shadow-lg">
                    </div>

                </div>

            </div>

            {{-- Pagination --}}
            <div>
                {{ $ulasan->links() }}
            </div>

        </div>

    </div>
</x-app-layout>
