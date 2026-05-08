<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

            {{-- Title --}}
            <div>
                <h2 class="text-xl font-bold text-[#1F1F1E]">
                    Manajemen Data Peminjam
                </h2>
                <p class="text-sm text-gray-500 mt-1">
                    Kelola seluruh data peminjam perpustakaan.
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

                {{-- Total --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
                    <p class="text-sm text-gray-500">
                        Total Peminjam
                    </p>

                    <h3 class="text-2xl font-bold text-[#1F1F1E] mt-2">
                        {{ $dataPeminjam->total() }}
                    </h3>
                </div>

                {{-- Export --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 flex items-center justify-between">

                    <div>
                        <p class="text-sm text-gray-500">
                            Export Data
                        </p>

                        <p class="text-sm text-[#1F1F1E] mt-1">
                            Download data peminjam dalam format Excel
                        </p>
                    </div>

                    <a href="{{ route('admin.data-peminjam.export') }}"
                        class="px-5 py-2.5 rounded-xl
                               bg-[#3D3D3B] hover:bg-[#2A2A28]
                               text-white text-sm font-medium
                               shadow-sm transition">
                        Export Excel
                    </a>

                </div>

            </div>

            {{-- Main Card --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">

                {{-- Top Section --}}
                <div class="px-6 py-5 border-b border-gray-100">

                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

                        <div>
                            <h3 class="font-semibold text-[#1F1F1E]">
                                Daftar Data Peminjam
                            </h3>

                            <p class="text-sm text-gray-500 mt-1">
                                Semua pengguna yang terdaftar sebagai peminjam.
                            </p>
                        </div>

                        {{-- Search --}}
                        <form method="GET"
                            class="flex gap-2">

                            <input type="text"
                                name="search"
                                value="{{ request('search') }}"
                                placeholder="Cari nama peminjam..."
                                class="w-64 border border-gray-300 rounded-xl
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
                                <th class="px-6 py-4 font-medium">
                                    No
                                </th>

                                <th class="px-6 py-4 font-medium">
                                    Nama
                                </th>

                                <th class="px-6 py-4 font-medium">
                                    Email
                                </th>

                                <th class="px-6 py-4 font-medium">
                                    Telepon
                                </th>

                                <th class="px-6 py-4 font-medium text-center">
                                    Aksi
                                </th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-100">

                            @forelse($dataPeminjam as $index => $peminjam)

                                <tr class="hover:bg-gray-50 transition">

                                    {{-- No --}}
                                    <td class="px-6 py-5 text-gray-600">
                                        {{ $dataPeminjam->firstItem() + $index }}
                                    </td>

                                    {{-- Nama --}}
                                    <td class="px-6 py-5">

                                        <div class="flex flex-col">

                                            <span class="font-semibold text-[#1F1F1E]">
                                                {{ $peminjam->nama }}
                                            </span>

                                        </div>

                                    </td>

                                    {{-- Email --}}
                                    <td class="px-6 py-5">

                                        <span class="text-sm text-gray-600">
                                            {{ $peminjam->email }}
                                        </span>

                                    </td>

                                    {{-- Telepon --}}
                                    <td class="px-6 py-5">

                                        @if($peminjam->profil?->nomor_telepon)
                                            <span class="inline-flex items-center
                                                         px-3 py-1 rounded-full
                                                         bg-[#F4F4F2]
                                                         text-[#1F1F1E]
                                                         text-xs font-medium">
                                                {{ $peminjam->profil->nomor_telepon }}
                                            </span>
                                        @else
                                            <span class="text-gray-400 text-sm">
                                                Belum diisi
                                            </span>
                                        @endif

                                    </td>

                                    {{-- Aksi --}}
                                    <td class="px-6 py-5 text-center">

                                        <form method="POST"
                                            action="{{ route('admin.data-peminjam.destroy', $peminjam->id) }}"
                                            onsubmit="return confirm('Yakin ingin menghapus data ini?')">

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

                                    </td>

                                </tr>

                            @empty

                                <tr>
                                    <td colspan="5" class="py-16 text-center">

                                        <div class="flex flex-col items-center gap-2">

                                            <div class="w-14 h-14 rounded-full bg-gray-100 flex items-center justify-center">
                                                👤
                                            </div>

                                            <p class="text-gray-500 font-medium">
                                                Tidak ada data peminjam
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
                {{ $dataPeminjam->links() }}
            </div>

        </div>

    </div>
</x-app-layout>