<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-[#09637E] leading-tight">
                Data Riwayat Peminjaman
            </h2>

            <a href="{{ route('admin.riwayat-peminjaman.export', ['search' => $search]) }}"
               class="bg-[#09637E] hover:bg-[#088395] text-white px-5 py-2 rounded-lg shadow transition">
                Export Excel
            </a>
        </div>
    </x-slot>

    <div class="py-10 bg-[#EBF4F6] min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Search --}}
            <div class="mb-6">
                <form method="GET" action="{{ route('admin.riwayat-peminjaman') }}">
                    <div class="flex gap-3">
                        <input type="text"
                               name="search"
                               value="{{ $search }}"
                               placeholder="Cari judul buku / nama peminjam..."
                               class="w-full rounded-lg border border-[#7AB2B2] px-4 py-2 focus:ring-2 focus:ring-[#088395] focus:outline-none text-sm">

                        <button class="bg-[#09637E] hover:bg-[#088395] text-white px-6 py-2 rounded-lg shadow">
                            Cari
                        </button>
                    </div>
                </form>
            </div>

            {{-- Table --}}
            <div class="bg-white shadow-xl rounded-2xl overflow-hidden">

                <table class="min-w-full text-sm text-gray-700">

                    <thead class="bg-[#09637E] text-white">
                        <tr>
                            <th class="px-6 py-3 text-left">Buku</th>
                            <th class="px-6 py-3 text-left">Peminjam</th>
                            <th class="px-6 py-3 text-left">Tanggal Pinjam</th>
                            <th class="px-6 py-3 text-left">Tanggal Kembali</th>
                            <th class="px-6 py-3 text-left">Status</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-100">

                        @forelse($riwayat as $item)
                            <tr class="hover:bg-gray-50">

                                <td class="px-6 py-4">
                                    {{ $item->buku->judul_buku }}
                                </td>

                                <td class="px-6 py-4">
                                    <div class="font-medium">
                                        {{ $item->peminjam->nama }}
                                    </div>
                                    <div class="text-xs text-gray-500">
                                        {{ $item->peminjam->username }}
                                    </div>
                                </td>

                                <td class="px-6 py-4">
                                    {{ \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d M Y') }}
                                </td>

                                <td class="px-6 py-4">
                                    {{ \Carbon\Carbon::parse($item->tanggal_kembali)->format('d M Y') }}
                                </td>

                                <td class="px-6 py-4">
                                    <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-semibold">
                                        Dikembalikan
                                    </span>
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-10 text-gray-500">
                                    Data riwayat belum tersedia.
                                </td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>

            </div>

            {{-- Pagination --}}
            <div class="mt-6">
                {{ $riwayat->links() }}
            </div>

        </div>
    </div>
</x-app-layout>
