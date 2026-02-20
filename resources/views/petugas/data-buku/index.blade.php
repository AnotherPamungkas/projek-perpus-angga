<x-app-layout>
    <x-slot name="header">
        Data Buku
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
            <div class="mb-4 bg-[#7AB2B2] text-white px-4 py-3 rounded-xl shadow">
                {{ session('success') }}
            </div>
            @endif

            @if(session('error'))
            <div class="mb-4 bg-red-100 text-red-600 px-4 py-3 rounded-xl shadow">
                {{ session('error') }}
            </div>
            @endif


            <div class="bg-white shadow-xl rounded-2xl p-6">

                {{-- Top Section --}}
                <div class="flex flex-col md:flex-row justify-between md:items-end gap-4 mb-6">

                    {{-- Search --}}
                    <form method="GET" class="flex gap-2">
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Cari judul / pengarang / kategori..."
                            class="border border-[#7AB2B2] rounded-lg px-4 py-2 focus:ring-2 focus:ring-[#088395] focus:outline-none w-64">

                        <button class="bg-[#09637E] text-white px-4 py-2 rounded-lg hover:bg-[#088395] transition">
                            Cari
                        </button>
                    </form>

                    {{-- Action Button --}}
                    <div class="flex gap-2">
                        <a href="{{ route('petugas.data-buku.export') }}"
                            class="bg-[#088395] text-white px-5 py-2 rounded-lg shadow hover:bg-[#09637E] transition">
                            Export Excel
                        </a>

                        <a href="{{ route('petugas.data-buku.create') }}"
                            class="bg-[#09637E] text-white px-5 py-2 rounded-lg shadow hover:bg-[#088395] transition">
                            + Tambah Buku
                        </a>
                    </div>
                </div>

                {{-- Table --}}
                <div class="overflow-x-auto">
                    <table class="w-full table-fixed text-sm text-left">
                        <thead class="bg-[#09637E] text-white">
                            <tr>
                                <th class="px-4 py-3 w-16">No</th>
                                <th class="px-4 py-3 w-1/4">Judul</th>
                                <th class="px-4 py-3 w-40">Kategori</th>
                                <th class="px-4 py-3 w-28 text-center">Jumlah</th>
                                <th class="px-4 py-3 w-32 text-center">Dipinjam</th>
                                <th class="px-4 py-3 w-32 text-center">Status</th>
                                <th class="px-4 py-3 w-40">Ditambahkan Oleh</th>
                                <th class="px-4 py-3 w-40 text-center">Aksi</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-200">
                            @forelse($buku as $index => $item)
                            <tr class="hover:bg-[#EBF4F6] transition">

                                <td class="px-4 py-3">
                                    {{ $buku->firstItem() + $index }}
                                </td>

                                <td class="px-4 py-3 font-medium">
                                    {{ $item->judul_buku }}
                                </td>

                                <td class="px-4 py-3">
                                    {{ $item->kategori->nama_kategori }}
                                </td>

                                <td class="px-4 py-3 text-center">
                                    {{ $item->jumlah_buku }}
                                </td>


                                <td class="px-4 py-3 text-center">
                                    @if($item->sedang_dipinjam > 0)
                                    <span
                                        class="px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-600">
                                        {{ $item->sedang_dipinjam }} Aktif
                                    </span>
                                    @else
                                    <span
                                        class="px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-600">
                                        0
                                    </span>
                                    @endif
                                </td>


                                <td class="px-4 py-3 text-center">
                                    <span class="px-3 py-1 rounded-full text-xs font-semibold
                                            {{ $item->status === 'tersedia'
                                                ? 'bg-green-100 text-green-600'
                                                : 'bg-red-100 text-red-600' }}">
                                        {{ ucfirst($item->status) }}
                                    </span>
                                </td>

                                <td class="px-4 py-3">
                                    <span class="text-[#09637E] font-semibold">
                                        {{ $item->creator->nama ?? $item->creator->username ?? '-' }}
                                    </span>
                                </td>

                                <td class="px-4 py-3 text-center space-x-2">
                                    <a href="{{ route('petugas.data-buku.edit', $item->id) }}"
                                        class="bg-[#7AB2B2] hover:bg-[#088395] text-white px-3 py-1 rounded-lg transition">
                                        Edit
                                    </a>

                                    @if($item->sedang_dipinjam > 0)
                                    <button disabled title="Buku sedang dipinjam"
                                        class="bg-gray-400 cursor-not-allowed text-white px-3 py-1 rounded-lg">
                                        Hapus
                                    </button>
                                    @else
                                    <form action="{{ route('admin.data-buku.destroy', $item->id) }}" method="POST"
                                        class="inline" onsubmit="return confirm('Hapus buku ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button
                                            class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg transition">
                                            Hapus
                                        </button>
                                    </form>
                                    @endif
                                </td>

                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center py-6 text-gray-500">
                                    Data buku kosong
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                <div class="mt-6">
                    {{ $buku->links() }}
                </div>

                <div class="mt-4 text-sm text-gray-500">
                    <p>
                        * Buku yang sedang dipinjam tidak dapat dihapus sampai semua peminjaman dikembalikan.
                    </p>
                </div>



            </div>
        </div>
    </div>
</x-app-layout>
