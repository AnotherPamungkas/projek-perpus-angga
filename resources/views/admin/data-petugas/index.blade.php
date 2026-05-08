<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

            {{-- Title --}}
            <div>
                <h2 class="text-xl font-bold text-[#1F1F1E]">
                    Manajemen Data Petugas
                </h2>
                <p class="text-sm text-gray-500 mt-1">
                    Kelola seluruh data petugas perpustakaan.
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

                {{-- Total Petugas --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
                    <p class="text-sm text-gray-500">
                        Total Petugas
                    </p>

                    <h3 class="text-2xl font-bold text-[#1F1F1E] mt-2">
                        {{ $petugas->total() }}
                    </h3>
                </div>

                {{-- Action Section --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 flex items-center justify-between">

                    <div>
                        <p class="text-sm text-gray-500">
                            Kelola Data
                        </p>

                        <p class="text-sm text-[#1F1F1E] mt-1">
                            Tambahkan atau export data petugas
                        </p>
                    </div>

                    <div class="flex gap-2">

                        <a href="{{ route('admin.data-petugas.create') }}"
                           class="px-5 py-2.5 rounded-xl
                                  bg-[#1F1F1E] hover:bg-[#2A2A28]
                                  text-white text-sm font-medium
                                  shadow-sm transition">
                            + Tambah
                        </a>

                        <a href="{{ route('admin.data-petugas.export') }}"
                           class="px-5 py-2.5 rounded-xl
                                  border border-[#D6D3D1]
                                  text-[#3D3D3B]
                                  hover:bg-[#F9F9F8]
                                  text-sm font-medium transition">
                            Export
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
                                Daftar Data Petugas
                            </h3>

                            <p class="text-sm text-gray-500 mt-1">
                                Semua petugas yang terdaftar dalam sistem.
                            </p>
                        </div>

                        {{-- Search --}}
                        <form method="GET" class="flex gap-2">

                            <input type="text"
                                   name="search"
                                   value="{{ request('search') }}"
                                   placeholder="Cari nama petugas..."
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
                                    Username
                                </th>

                                <th class="px-6 py-4 font-medium">
                                    Email
                                </th>

                                <th class="px-6 py-4 font-medium text-center">
                                    Aksi
                                </th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-100">

                            @forelse($petugas as $index => $item)

                                <tr class="hover:bg-gray-50 transition">

                                    {{-- No --}}
                                    <td class="px-6 py-5 text-gray-600">
                                        {{ $petugas->firstItem() + $index }}
                                    </td>

                                    {{-- Nama --}}
                                    <td class="px-6 py-5">
                                        <span class="font-semibold text-[#1F1F1E]">
                                            {{ $item->nama }}
                                        </span>
                                    </td>

                                    {{-- Username --}}
                                    <td class="px-6 py-5 text-gray-600">
                                        {{ $item->username }}
                                    </td>

                                    {{-- Email --}}
                                    <td class="px-6 py-5 text-gray-600">
                                        {{ $item->email }}
                                    </td>

                                    {{-- Aksi --}}
                                    <td class="px-6 py-5 text-center">

                                        <div class="flex justify-center gap-2">

                                            <a href="{{ route('admin.data-petugas.edit', $item->id) }}"
                                               class="px-4 py-2 rounded-xl
                                                      bg-[#3D3D3B] hover:bg-[#2A2A28]
                                                      text-white text-xs font-medium
                                                      transition shadow-sm">
                                                Edit
                                            </a>

                                            <form action="{{ route('admin.data-petugas.destroy', $item->id) }}"
                                                  method="POST"
                                                  onsubmit="return confirm('Yakin hapus petugas ini?')">

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

                                        </div>

                                    </td>

                                </tr>

                            @empty

                                <tr>
                                    <td colspan="5" class="py-16 text-center">

                                        <div class="flex flex-col items-center gap-2">

                                            <div class="w-14 h-14 rounded-full bg-gray-100 flex items-center justify-center">
                                                👨‍💼
                                            </div>

                                            <p class="text-gray-500 font-medium">
                                                Tidak ada data petugas
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
                {{ $petugas->links() }}
            </div>

        </div>

    </div>
</x-app-layout>
