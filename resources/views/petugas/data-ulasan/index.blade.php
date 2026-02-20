<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-[#09637E] leading-tight">
                Manajemen Data Ulasan
            </h2>

            <a href="{{ route('petugas.data-ulasan.export') }}"
                class="inline-flex items-center gap-2 bg-[#09637E] hover:bg-[#088395] text-white px-5 py-2 rounded-lg shadow transition">

                {{-- Icon Export --}}
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 4v12m0 0l-3-3m3 3l3-3M4 20h16" />
                </svg>

                Export Excel
            </a>
        </div>
    </x-slot>

    <div class="py-10 bg-[#EBF4F6] min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div x-data="{ openImage: false, imageUrl: '' }">

                <div class="bg-white shadow-xl rounded-2xl overflow-hidden">

                    <div class="px-6 py-5 border-b border-gray-100">
                        <h3 class="text-sm font-semibold text-gray-600">
                            Daftar Seluruh Ulasan Pengguna
                        </h3>
                    </div>

                    <div class="overflow-x-auto">

                        <table class="min-w-full text-sm text-gray-700">

                            <thead class="bg-[#09637E] text-white text-sm">
                                <tr>
                                    <th class="px-6 py-3 text-left font-medium">Buku</th>
                                    <th class="px-6 py-3 text-left font-medium">Peminjam</th>
                                    <th class="px-6 py-3 text-left font-medium">Rating</th>
                                    <th class="px-6 py-3 text-left font-medium">Ulasan</th>
                                    <th class="px-6 py-3 text-left font-medium">Tanggal</th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-gray-100">

                                @forelse($ulasan as $item)
                                <tr class="hover:bg-gray-50 transition">

                                    {{-- Buku --}}
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">

                                            {{-- Thumbnail kecil --}}
                                            <img src="{{ asset('storage/cover-buku/'.$item->buku->cover) }}"
                                                class="w-16 h-20 object-cover rounded cursor-pointer hover:scale-105 transition shadow-sm"
                                                @click="
                                            imageUrl = '{{ asset('storage/cover-buku/'.$item->buku->cover) }}';
                                            openImage = true
                                         ">

                                            <div>
                                                <p class="font-medium text-gray-800 text-sm">
                                                    {{ $item->buku->judul_buku }}
                                                </p>
                                            </div>
                                        </div>
                                    </td>

                                    {{-- Peminjam --}}
                                    <td class="px-6 py-4">
                                        <p class="font-medium text-gray-800 text-sm">
                                            {{ $item->peminjam->nama }}
                                        </p>
                                        <p class="text-xs text-gray-500">
                                            {{ $item->peminjam->username }}
                                        </p>
                                    </td>

                                    {{-- Rating --}}
                                    <td class="px-6 py-4">
                                        <span
                                            class="inline-flex items-center gap-1 bg-[#EBF4F6] text-[#09637E] px-3 py-1 rounded-full text-xs font-semibold">
                                            ⭐ {{ $item->rating }}
                                        </span>
                                    </td>

                                    {{-- Ulasan --}}
                                    <td class="px-6 py-4 max-w-xs truncate text-sm">
                                        {{ $item->isi_ulasan }}
                                    </td>

                                    {{-- Tanggal --}}
                                    <td class="px-6 py-4 text-sm text-gray-600">
                                        {{ $item->created_at->format('d M Y') }}
                                    </td>

                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center py-10 text-gray-500">
                                        Belum ada ulasan yang tersedia.
                                    </td>
                                </tr>
                                @endforelse

                            </tbody>

                        </table>

                    </div>
                </div>

                {{-- IMAGE MODAL --}}
                <div x-show="openImage" x-transition.opacity
                    class="fixed inset-0 bg-black bg-opacity-60 flex items-center justify-center z-50">

                    <div class="relative bg-white rounded-2xl p-4 shadow-2xl max-w-md w-full"
                        @click.away="openImage = false">

                        {{-- Close Button --}}
                        <button @click="openImage = false"
                            class="absolute top-3 right-3 text-gray-500 hover:text-gray-700">
                            ✕
                        </button>

                        <img :src="imageUrl" class="w-full h-auto rounded-lg shadow-lg">

                    </div>
                </div>

            </div>


            {{-- Pagination --}}
            <div class="mt-6">
                {{ $ulasan->links() }}
            </div>

        </div>
    </div>
</x-app-layout>
