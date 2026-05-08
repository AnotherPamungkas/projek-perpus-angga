<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

            {{-- Title --}}
            <div>
                <h2 class="text-xl font-bold text-[#1F1F1E]">
                    Data Riwayat Peminjaman
                </h2>
                <p class="text-sm text-gray-500 mt-1">
                    Riwayat seluruh transaksi peminjaman buku oleh peminjam.
                </p>
            </div>

            {{-- Export --}}
            <a href="{{ route('admin.riwayat-peminjaman.export', ['search' => $search]) }}"
               class="px-5 py-2.5 rounded-xl
                      bg-[#3D3D3B]
                      hover:bg-[#2A2A28]
                      text-white text-sm font-medium
                      shadow-sm transition">
                Export Excel
            </a>

        </div>
    </x-slot>

    <div class="py-8 bg-[#F7F7F5] min-h-screen">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Summary --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                {{-- Total Riwayat --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
                    <p class="text-sm text-gray-500">
                        Total Riwayat
                    </p>

                    <h3 class="text-2xl font-bold text-[#1F1F1E] mt-2">
                        {{ $riwayat->total() }}
                    </h3>
                </div>

                {{-- Info --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 flex items-center justify-between">

                    <div>
                        <p class="text-sm text-gray-500">
                            Informasi
                        </p>

                        <p class="text-sm text-[#1F1F1E] mt-1">
                            Data transaksi buku yang telah selesai dikembalikan.
                        </p>
                    </div>

                </div>

            </div>

            {{-- Main Card --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">

                {{-- Top Section --}}
                <div class="px-6 py-5 border-b border-gray-100">

                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

                        {{-- Title --}}
                        <div>
                            <h3 class="font-semibold text-[#1F1F1E]">
                                Daftar Riwayat Peminjaman
                            </h3>

                            <p class="text-sm text-gray-500 mt-1">
                                Semua riwayat peminjaman yang telah selesai.
                            </p>
                        </div>

                        {{-- Search --}}
                        <form method="GET"
                              action="{{ route('admin.riwayat-peminjaman') }}"
                              class="flex gap-2">

                            <input type="text"
                                   name="search"
                                   value="{{ $search }}"
                                   placeholder="Cari buku / peminjam..."
                                   class="w-64 border border-gray-300 rounded-xl
                                          px-4 py-2 text-sm
                                          focus:ring-2 focus:ring-[#3D3D3B]
                                          focus:border-[#3D3D3B]
                                          focus:outline-none">

                            <button
                                class="px-4 py-2 rounded-xl
                                       bg-[#3D3D3B]
                                       hover:bg-[#2A2A28]
                                       text-white text-sm transition">
                                Cari
                            </button>

                        </form>

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
                                    Tanggal Pinjam
                                </th>

                                <th class="px-6 py-4 font-medium">
                                    Tanggal Kembali
                                </th>

                                <th class="px-6 py-4 font-medium">
                                    Status
                                </th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-100">

                            @forelse($riwayat as $item)

                                <tr class="hover:bg-gray-50 transition">

                                    {{-- Buku --}}
                                    <td class="px-6 py-5">
                                        <span class="font-semibold text-[#1F1F1E]">
                                            {{ $item->buku->judul_buku }}
                                        </span>
                                    </td>

                                    {{-- Peminjam --}}
                                    <td class="px-6 py-5">

                                        <div class="flex flex-col">
                                            <span class="font-medium text-[#1F1F1E]">
                                                {{ $item->peminjam->nama }}
                                            </span>

                                            <span class="text-xs text-gray-500">
                                                {{ $item->peminjam->username }}
                                            </span>
                                        </div>

                                    </td>

                                    {{-- Tanggal Pinjam --}}
                                    <td class="px-6 py-5 text-gray-600">
                                        {{ \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d M Y') }}
                                    </td>

                                    {{-- Tanggal Kembali --}}
                                    <td class="px-6 py-5 text-gray-600">
                                        {{ \Carbon\Carbon::parse($item->tanggal_kembali)->format('d M Y') }}
                                    </td>

                                    {{-- Status --}}
                                    <td class="px-6 py-5">

                                        <span class="inline-flex items-center
                                                     px-3 py-1 rounded-full
                                                     bg-[#F4F4F2]
                                                     text-[#1F1F1E]
                                                     text-xs font-medium">
                                            Dikembalikan
                                        </span>

                                    </td>

                                </tr>

                            @empty

                                <tr>
                                    <td colspan="5" class="py-16 text-center">

                                        <div class="flex flex-col items-center gap-2">

                                            <div class="w-14 h-14 rounded-full bg-gray-100 flex items-center justify-center">
                                                📚
                                            </div>

                                            <p class="text-gray-500 font-medium">
                                                Data riwayat belum tersedia
                                            </p>

                                        </div>

                                    </td>
                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

            {{-- Pagination --}}
            <div>
                {{ $riwayat->links() }}
            </div>

        </div>

    </div>
</x-app-layout>
