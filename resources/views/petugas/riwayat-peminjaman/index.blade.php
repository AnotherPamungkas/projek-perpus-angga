<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

            {{-- Title --}}
            <div>
                <h2 class="text-xl font-bold text-[#1F1F1E]">
                    Riwayat Peminjaman
                </h2>
                <p class="text-sm text-gray-500 mt-1">
                    Data histori peminjaman yang telah selesai diproses.
                </p>
            </div>

            {{-- Export --}}
            <a href="{{ route('petugas.riwayat-peminjaman.export', ['search' => $search]) }}"
                class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl
                       bg-[#3D3D3B] hover:bg-[#2A2A28]
                       text-white text-sm font-medium shadow-sm transition">

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

            {{-- Summary Cards --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-6">

                {{-- Total --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
                    <p class="text-sm text-gray-500">
                        Total Riwayat
                    </p>
                    <h3 class="text-2xl font-bold text-[#1F1F1E] mt-2">
                        {{ $riwayat->total() }}
                    </h3>
                </div>

                {{-- Dikembalikan --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
                    <p class="text-sm text-gray-500">
                        Dikembalikan
                    </p>
                    <h3 class="text-2xl font-bold text-green-600 mt-2">
                        {{ $riwayat->where('status', 'dikembalikan')->count() }}
                    </h3>
                </div>

                {{-- Ditolak --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
                    <p class="text-sm text-gray-500">
                        Ditolak
                    </p>
                    <h3 class="text-2xl font-bold text-red-500 mt-2">
                        {{ $riwayat->where('status', 'ditolak')->count() }}
                    </h3>
                </div>

            </div>

            {{-- Search --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 mb-6">

                <form method="GET"
                    action="{{ route('petugas.riwayat-peminjaman.index') }}">

                    <div class="flex flex-col md:flex-row gap-3">

                        <input type="text"
                            name="search"
                            value="{{ $search }}"
                            placeholder="Cari judul buku / nama peminjam..."
                            class="w-full rounded-xl border border-gray-300
                                   px-4 py-3 text-sm
                                   focus:ring-2 focus:ring-[#3D3D3B]
                                   focus:border-[#3D3D3B]
                                   focus:outline-none">

                        <button
                            class="px-6 py-3 rounded-xl
                                   bg-[#3D3D3B] hover:bg-[#2A2A28]
                                   text-white text-sm font-medium
                                   shadow-sm transition">

                            Cari

                        </button>

                    </div>

                </form>

            </div>

            {{-- Table --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">

                {{-- Table Header --}}
                <div class="px-6 py-5 border-b border-gray-100">
                    <h3 class="font-semibold text-[#1F1F1E]">
                        Daftar Riwayat Peminjaman
                    </h3>
                    <p class="text-sm text-gray-500 mt-1">
                        Histori seluruh transaksi peminjaman buku.
                    </p>
                </div>

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
                                    Tanggal Pinjam
                                </th>
                                <th class="px-6 py-4 text-left font-medium">
                                    Tanggal Kembali
                                </th>
                                <th class="px-6 py-4 text-left font-medium">
                                    Status
                                </th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-100">

                            @forelse($riwayat as $item)

                                <tr class="hover:bg-gray-50 transition">

                                    {{-- Buku --}}
                                    <td class="px-6 py-5">

                                        <div class="flex flex-col">

                                            <span class="font-semibold text-[#1F1F1E]">
                                                {{ $item->buku->judul_buku }}
                                            </span>

                                            <span class="text-xs text-gray-500 mt-1">
                                                {{ $item->buku->kategori->nama_kategori ?? '-' }}
                                            </span>

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

                                    {{-- Tanggal Pinjam --}}
                                    <td class="px-6 py-5 text-gray-600">
                                        {{ \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d M Y') }}
                                    </td>

                                    {{-- Tanggal Kembali --}}
                                    <td class="px-6 py-5 text-gray-600">
                                        {{ $item->tanggal_kembali
                                            ? \Carbon\Carbon::parse($item->tanggal_kembali)->format('d M Y')
                                            : '-' }}
                                    </td>

                                    {{-- Status --}}
                                    <td class="px-6 py-5">

                                        @if($item->status == 'dikembalikan')
                                            <span class="inline-flex items-center
                                                         bg-green-50 text-green-600
                                                         px-3 py-1 rounded-full
                                                         text-xs font-semibold">

                                                Dikembalikan

                                            </span>
                                        @else
                                            <span class="inline-flex items-center
                                                         bg-red-50 text-red-500
                                                         px-3 py-1 rounded-full
                                                         text-xs font-semibold">

                                                Ditolak

                                            </span>
                                        @endif

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
            <div class="mt-6">
                {{ $riwayat->links() }}
            </div>

        </div>
    </div>
</x-app-layout>
