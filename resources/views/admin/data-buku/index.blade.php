<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

            {{-- Title --}}
            <div>
                <h2 class="text-xl font-bold text-[#1F1F1E]">
                    Manajemen Data Buku
                </h2>
                <p class="text-sm text-gray-500 mt-1">
                    Kelola seluruh data buku perpustakaan.
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

            {{-- Alert Error --}}
            @if(session('error'))
                <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-2xl shadow-sm">
                    {{ session('error') }}
                </div>
            @endif

            {{-- Summary --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                {{-- Total Buku --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
                    <p class="text-sm text-gray-500">
                        Total Buku
                    </p>

                    <h3 class="text-2xl font-bold text-[#1F1F1E] mt-2">
                        {{ $buku->total() }}
                    </h3>
                </div>

                {{-- Action Card --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 flex items-center justify-between">

                    <div>
                        <p class="text-sm text-gray-500">
                            Kelola Data
                        </p>

                        <p class="text-sm text-[#1F1F1E] mt-1">
                            Tambah buku baru atau export data buku.
                        </p>
                    </div>

                    <div class="flex gap-2">
                        <a href="{{ route('admin.data-buku.export') }}"
                           class="px-5 py-2.5 rounded-xl border border-[#D6D3D1]
                                  text-[#3D3D3B] hover:bg-[#F9F9F8]
                                  text-sm transition">
                            Export Excel
                        </a>

                        <a href="{{ route('admin.data-buku.create') }}"
                           class="px-5 py-2.5 rounded-xl
                                  bg-[#3D3D3B] hover:bg-[#2A2A28]
                                  text-white text-sm font-medium
                                  shadow-sm transition">
                            + Tambah Buku
                        </a>
                    </div>

                </div>

            </div>

            {{-- Main Card --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">

                {{-- Top Section --}}
                <div class="px-6 py-5 border-b border-gray-100">

                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

                        <div>
                            <h3 class="font-semibold text-[#1F1F1E]">
                                Daftar Data Buku
                            </h3>

                            <p class="text-sm text-gray-500 mt-1">
                                Semua buku yang tersedia di perpustakaan.
                            </p>
                        </div>

                        {{-- Search --}}
                        <form method="GET" class="flex gap-2">

                            <input type="text"
                                   name="search"
                                   value="{{ request('search') }}"
                                   placeholder="Cari judul / pengarang / kategori..."
                                   class="w-72 border border-gray-300 rounded-xl
                                          px-4 py-2 text-sm
                                          focus:ring-2 focus:ring-[#3D3D3B]
                                          focus:border-[#3D3D3B]
                                          focus:outline-none">

                            <button
                                class="px-4 py-2 rounded-xl
                                       bg-[#3D3D3B] hover:bg-[#2A2A28]
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
                                <th class="px-6 py-4 font-medium">No</th>
                                <th class="px-6 py-4 font-medium">Judul</th>
                                <th class="px-6 py-4 font-medium">Kategori</th>
                                <th class="px-6 py-4 font-medium text-center">Jumlah</th>
                                <th class="px-6 py-4 font-medium text-center">Dipinjam</th>
                                <th class="px-6 py-4 font-medium text-center">Status</th>
                                <th class="px-6 py-4 font-medium">Ditambahkan Oleh</th>
                                <th class="px-6 py-4 font-medium text-center">Aksi</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-100">

                            @forelse($buku as $index => $item)

                                <tr class="hover:bg-gray-50 transition">

                                    {{-- No --}}
                                    <td class="px-6 py-5 text-gray-600">
                                        {{ $buku->firstItem() + $index }}
                                    </td>

                                    {{-- Judul --}}
                                    <td class="px-6 py-5 font-semibold text-[#1F1F1E]">
                                        {{ $item->judul_buku }}
                                    </td>

                                    {{-- Kategori --}}
                                    <td class="px-6 py-5 text-gray-600">
                                        {{ $item->kategori->nama_kategori }}
                                    </td>

                                    {{-- Jumlah --}}
                                    <td class="px-6 py-5 text-center text-gray-600">
                                        {{ $item->jumlah_buku }}
                                    </td>

                                    {{-- Dipinjam --}}
                                    <td class="px-6 py-5 text-center">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full bg-[#F4F4F2] text-[#1F1F1E] text-xs font-medium">
                                            {{ $item->sedang_dipinjam }} Aktif
                                        </span>
                                    </td>

                                    {{-- Status --}}
                                    <td class="px-6 py-5 text-center">
                                        <span class="px-3 py-1 rounded-full text-xs font-medium
                                            {{ $item->status === 'tersedia'
                                                ? 'bg-green-100 text-green-700'
                                                : 'bg-red-100 text-red-700' }}">
                                            {{ ucfirst($item->status) }}
                                        </span>
                                    </td>

                                    {{-- Creator --}}
                                    <td class="px-6 py-5 text-[#1F1F1E] font-medium">
                                        {{ $item->creator->nama ?? $item->creator->username ?? '-' }}
                                    </td>

                                    {{-- Aksi --}}
                                    <td class="px-6 py-5 text-center">

                                        <div class="flex justify-center gap-2">

                                            <a href="{{ route('admin.data-buku.edit', $item->id) }}"
                                               class="px-4 py-2 rounded-xl
                                                      bg-[#3D3D3B] hover:bg-[#2A2A28]
                                                      text-white text-xs font-medium transition">
                                                Edit
                                            </a>

                                            @if($item->sedang_dipinjam > 0)
                                                <button disabled
                                                        title="Buku sedang dipinjam"
                                                        class="px-4 py-2 rounded-xl
                                                               bg-gray-300 text-gray-500
                                                               cursor-not-allowed text-xs">
                                                    Hapus
                                                </button>
                                            @else
                                                <form action="{{ route('admin.data-buku.destroy', $item->id) }}"
                                                      method="POST"
                                                      onsubmit="return confirm('Hapus buku ini?')">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button
                                                        class="px-4 py-2 rounded-xl
                                                               bg-red-500 hover:bg-red-600
                                                               text-white text-xs font-medium transition">
                                                        Hapus
                                                    </button>
                                                </form>
                                            @endif

                                        </div>

                                    </td>

                                </tr>

                            @empty

                                <tr>
                                    <td colspan="8" class="py-16 text-center">

                                        <div class="flex flex-col items-center gap-2">

                                            <div class="w-14 h-14 rounded-full bg-gray-100 flex items-center justify-center">
                                                📚
                                            </div>

                                            <p class="text-gray-500 font-medium">
                                                Tidak ada data buku
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
                {{ $buku->links() }}
            </div>

            {{-- Note --}}
            <div class="bg-yellow-50 border border-yellow-200 rounded-2xl p-4">
                <p class="text-sm text-yellow-700">
                    * Buku yang sedang dipinjam tidak dapat dihapus sampai semua peminjaman selesai.
                </p>
            </div>

        </div>

    </div>
</x-app-layout>
