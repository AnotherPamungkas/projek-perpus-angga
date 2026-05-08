<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

            {{-- Title --}}
            <div>
                <h2 class="text-xl font-bold text-[#1F1F1E]">
                    Data Ulasan Peminjam
                </h2>
                <p class="text-sm text-gray-500 mt-1">
                    Kelola dan pantau seluruh ulasan dari peminjam.
                </p>
            </div>

            {{-- Export Button --}}
            <a href="{{ route('petugas.data-ulasan.export') }}"
                class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl
                       bg-[#3D3D3B] hover:bg-[#2A2A28]
                       text-white text-sm font-medium
                       shadow-sm transition">

                <svg xmlns="http://www.w3.org/2000/svg"
                    class="w-4 h-4"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor">

                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M12 4v12m0 0l-3-3m3 3l3-3M4 20h16" />
                </svg>

                Export Excel
            </a>

        </div>
    </x-slot>

    <div class="py-8 bg-[#F7F7F5] min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Alert --}}
            @if(session('success'))
                <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-2xl">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Summary Cards --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-6">

                {{-- Total Ulasan --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
                    <p class="text-sm text-gray-500">
                        Total Ulasan
                    </p>
                    <h3 class="text-2xl font-bold text-[#1F1F1E] mt-2">
                        {{ $ulasan->total() }}
                    </h3>
                </div>

                {{-- Rating Rata-rata --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
                    <p class="text-sm text-gray-500">
                        Rata-rata Rating
                    </p>
                    <h3 class="text-2xl font-bold text-[#1F1F1E] mt-2">
                        {{ number_format($ulasan->avg('rating'), 1) ?? '0.0' }}
                    </h3>
                </div>

            </div>

            <div x-data="{ openImage: false, imageUrl: '' }">

                {{-- Main Card --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">

                    {{-- Top Bar --}}
                    <div class="px-6 py-5 border-b border-gray-100">

                        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

                            <div>
                                <h3 class="font-semibold text-[#1F1F1E]">
                                    Daftar Ulasan
                                </h3>
                                <p class="text-sm text-gray-500 mt-1">
                                    Semua ulasan yang diberikan oleh peminjam.
                                </p>
                            </div>

                            {{-- Search --}}
                            <form method="GET" class="flex gap-2">

                                <input type="text"
                                    name="search"
                                    value="{{ request('search') }}"
                                    placeholder="Cari buku / peminjam..."
                                    class="w-64 border border-gray-300 rounded-xl px-4 py-2 text-sm
                                           focus:ring-2 focus:ring-[#3D3D3B]
                                           focus:border-[#3D3D3B]
                                           focus:outline-none">

                                <button
                                    class="px-4 py-2 rounded-xl bg-[#3D3D3B] hover:bg-[#2A2A28]
                                           text-white text-sm transition">
                                    Cari
                                </button>

                            </form>

                        </div>

                    </div>

                    {{-- Table --}}
                    <div class="overflow-x-auto">

                        <table class="min-w-full text-sm text-gray-700">

                            <thead class="bg-[#1F1F1E] text-white">
                                <tr>
                                    <th class="px-6 py-4 text-left font-medium">
                                        Buku
                                    </th>
                                    <th class="px-6 py-4 text-left font-medium">
                                        Peminjam
                                    </th>
                                    <th class="px-6 py-4 text-left font-medium">
                                        Rating
                                    </th>
                                    <th class="px-6 py-4 text-left font-medium">
                                        Ulasan
                                    </th>
                                    <th class="px-6 py-4 text-left font-medium">
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
                                                    class="w-14 h-20 object-cover rounded-xl shadow-sm
                                                           cursor-pointer hover:scale-105 transition"
                                                    @click="
                                                        imageUrl = '{{ asset('storage/cover-buku/'.$item->buku->cover) }}';
                                                        openImage = true
                                                    ">

                                                <div>
                                                    <p class="font-semibold text-[#1F1F1E]">
                                                        {{ $item->buku->judul_buku }}
                                                    </p>

                                                    <p class="text-xs text-gray-500 mt-1">
                                                        {{ $item->buku->kategori->nama_kategori }}
                                                    </p>
                                                </div>

                                            </div>

                                        </td>

                                        {{-- Peminjam --}}
                                        <td class="px-6 py-5">

                                            <p class="font-medium text-[#1F1F1E]">
                                                {{ $item->peminjam->nama }}
                                            </p>

                                            <p class="text-xs text-gray-500 mt-1">
                                                {{ $item->peminjam->username }}
                                            </p>

                                        </td>

                                        {{-- Rating --}}
                                        <td class="px-6 py-5">

                                            <span
                                                class="inline-flex items-center gap-1
                                                       bg-[#F4F4F2]
                                                       text-[#1F1F1E]
                                                       px-3 py-1 rounded-full
                                                       text-xs font-semibold">

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
                                        <td class="px-6 py-5 text-sm text-gray-500">
                                            {{ $item->created_at->format('d M Y') }}
                                        </td>

                                    </tr>

                                @empty

                                    <tr>
                                        <td colspan="5" class="py-16 text-center">

                                            <div class="flex flex-col items-center gap-2">

                                                <div class="w-14 h-14 rounded-full bg-gray-100 flex items-center justify-center">
                                                    📝
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
                        @click.away="openImage = false">

                        {{-- Close --}}
                        <button @click="openImage = false"
                            class="absolute top-3 right-3 w-8 h-8 rounded-full
                                   bg-gray-100 hover:bg-gray-200
                                   flex items-center justify-center transition">

                            ✕

                        </button>

                        <img :src="imageUrl"
                            class="w-full rounded-xl shadow-sm">

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
