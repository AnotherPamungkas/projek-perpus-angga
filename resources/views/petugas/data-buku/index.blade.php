<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold text-[#3D3D3B]">
            Data Buku
        </h2>
    </x-slot>

    <div class="py-8 bg-[#F4F4F2] min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Alert --}}
            @if(session('success'))
                <div class="bg-green-50 border border-green-200 text-green-700 px-5 py-4 rounded-2xl shadow-sm">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-50 border border-red-200 text-red-600 px-5 py-4 rounded-2xl shadow-sm">
                    {{ session('error') }}
                </div>
            @endif

            <div class="bg-[#E8E8E8] border border-[#BBBFCA] rounded-2xl shadow-sm p-6">

                {{-- Top Section --}}
                <div class="flex flex-col lg:flex-row justify-between gap-4 mb-6">

                    {{-- Search --}}
                    <form method="GET" class="flex gap-2 w-full lg:w-auto">
                        <input type="text"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Cari buku..."
                            class="w-full lg:w-80 rounded-xl border border-[#BBBFCA] bg-white px-4 py-3 focus:ring-2 focus:ring-[#3D3D3B] focus:outline-none">

                        <button
                            class="px-5 py-3 rounded-xl bg-[#3D3D3B] text-white font-medium hover:opacity-90 transition">
                            Cari
                        </button>
                    </form>

                    {{-- Actions --}}
                    <div class="flex gap-3">

                        <a href="{{ route('petugas.data-buku.export') }}"
                            class="px-5 py-3 rounded-xl border border-[#BBBFCA] bg-white text-[#3D3D3B] font-medium hover:bg-[#F4F4F2] transition">
                            Export Excel
                        </a>

                        <a href="{{ route('petugas.data-buku.create') }}"
                            class="px-5 py-3 rounded-xl bg-[#3D3D3B] text-white font-medium hover:opacity-90 transition">
                            + Tambah Buku
                        </a>

                    </div>

                </div>

                {{-- Table --}}
                <div class="overflow-x-auto rounded-2xl border border-[#BBBFCA] bg-white">
                    <table class="w-full text-sm text-left">

                        <thead class="bg-[#3D3D3B] text-white">
                            <tr>
                                <th class="px-4 py-4">No</th>
                                <th class="px-4 py-4">Judul</th>
                                <th class="px-4 py-4">Kategori</th>
                                <th class="px-4 py-4 text-center">Jumlah</th>
                                <th class="px-4 py-4 text-center">Dipinjam</th>
                                <th class="px-4 py-4 text-center">Status</th>
                                <th class="px-4 py-4">Ditambahkan Oleh</th>
                                <th class="px-4 py-4 text-center">Aksi</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-[#BBBFCA]">

                            @forelse($buku as $index => $item)
                                <tr class="hover:bg-[#F4F4F2] transition">

                                    <td class="px-4 py-4">
                                        {{ $buku->firstItem() + $index }}
                                    </td>

                                    <td class="px-4 py-4 font-semibold text-[#3D3D3B]">
                                        {{ $item->judul_buku }}
                                    </td>

                                    <td class="px-4 py-4">
                                        {{ $item->kategori->nama_kategori }}
                                    </td>

                                    <td class="px-4 py-4 text-center">
                                        {{ $item->jumlah_buku }}
                                    </td>

                                    <td class="px-4 py-4 text-center">
                                        <span class="px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-600">
                                            {{ $item->sedang_dipinjam }}
                                        </span>
                                    </td>

                                    <td class="px-4 py-4 text-center">
                                        <span class="px-3 py-1 rounded-full text-xs font-semibold
                                            {{ $item->status === 'tersedia'
                                                ? 'bg-green-100 text-green-600'
                                                : 'bg-red-100 text-red-600' }}">
                                            {{ ucfirst($item->status) }}
                                        </span>
                                    </td>

                                    <td class="px-4 py-4 font-medium text-[#3D3D3B]">
                                        {{ $item->creator->nama ?? '-' }}
                                    </td>

                                    <td class="px-4 py-4 text-center space-x-2">

                                        <a href="{{ route('petugas.data-buku.edit', $item->id) }}"
                                            class="px-3 py-2 rounded-xl bg-[#3D3D3B] text-white hover:opacity-90 transition">
                                            Edit
                                        </a>

                                        @if($item->sedang_dipinjam > 0)
                                            <button disabled
                                                class="px-3 py-2 rounded-xl bg-gray-300 text-gray-500 cursor-not-allowed">
                                                Hapus
                                            </button>
                                        @else
                                            <form action="{{ route('petugas.data-buku.destroy', $item->id) }}"
                                                method="POST"
                                                class="inline"
                                                onsubmit="return confirm('Hapus buku ini?')">
                                                @csrf
                                                @method('DELETE')

                                                <button
                                                    class="px-3 py-2 rounded-xl bg-red-500 text-white hover:bg-red-600 transition">
                                                    Hapus
                                                </button>
                                            </form>
                                        @endif

                                    </td>

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8"
                                        class="py-10 text-center text-[#3D3D3B]/60">
                                        Data buku masih kosong.
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

                {{-- Note --}}
                <div class="mt-4 text-sm text-[#3D3D3B]/60">
                    * Buku yang sedang dipinjam tidak dapat dihapus.
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
