<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-[#1557b0]">
            Manajemen Data Petugas
        </h2>
    </x-slot>

    <div class="py-8 min-h-screen
        bg-gradient-to-br from-[#eaf2ff] via-white to-[#d6e6ff]">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Alert --}}
            @if(session('success'))
            <div class="bg-blue-50 border border-blue-200 text-[#1557b0] px-4 py-3 rounded-xl shadow-sm">
                {{ session('success') }}
            </div>
            @endif

            <div class="bg-white shadow-sm rounded-2xl p-6 border border-blue-100">

                {{-- Top Section --}}
                <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-4 mb-6">

                    {{-- Search --}}
                    <form method="GET" class="flex gap-2 w-full md:w-auto">
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Cari nama / username / email..."
                            class="w-full md:w-64 border border-gray-200 rounded-lg px-4 py-2 text-sm
                            focus:ring-2 focus:ring-[#1a73e8] focus:border-[#1a73e8] focus:outline-none">

                        <button
                            class="px-4 py-2 rounded-lg text-white text-sm
                            bg-gradient-to-r from-[#1557b0] to-[#1a73e8]
                            hover:from-[#144a96] hover:to-[#1666cc] transition">
                            Cari
                        </button>
                    </form>

                    {{-- Actions --}}
                    <div class="flex flex-wrap gap-2">

                        <a href="{{ route('admin.data-petugas.create') }}"
                            class="px-5 py-2 rounded-lg text-white text-sm shadow-sm
                            bg-gradient-to-r from-[#1557b0] to-[#1a73e8]
                            hover:from-[#144a96] hover:to-[#1666cc] transition">
                            + Tambah Petugas
                        </a>

                        <a href="{{ route('admin.data-petugas.export') }}"
                            class="px-5 py-2 rounded-lg text-sm border border-blue-200 text-[#1a73e8]
                            hover:bg-blue-50 transition">
                            Export Excel
                        </a>

                    </div>

                </div>

                {{-- Table --}}
                <div class="overflow-x-auto rounded-xl">
                    <table class="min-w-full text-sm text-left">

                        <thead class="bg-gradient-to-r from-[#1557b0] to-[#1a73e8] text-white">
                            <tr>
                                <th class="px-4 py-3">No</th>
                                <th class="px-4 py-3">Nama</th>
                                <th class="px-4 py-3">Username</th>
                                <th class="px-4 py-3">Email</th>
                                <th class="px-4 py-3 text-center">Aksi</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-100 bg-white">
                            @forelse($petugas as $index => $item)
                            <tr class="hover:bg-blue-50 transition">

                                <td class="px-4 py-3">
                                    {{ $petugas->firstItem() + $index }}
                                </td>

                                <td class="px-4 py-3 font-medium text-gray-700">
                                    {{ $item->nama }}
                                </td>

                                <td class="px-4 py-3 text-gray-600">
                                    {{ $item->username }}
                                </td>

                                <td class="px-4 py-3 text-gray-600">
                                    {{ $item->email }}
                                </td>

                                <td class="px-4 py-3 text-center space-x-2">

                                    <a href="{{ route('admin.data-petugas.edit', $item->id) }}"
                                        class="px-3 py-1 text-xs rounded-lg text-white
                                        bg-blue-500 hover:bg-blue-600 transition">
                                        Edit
                                    </a>

                                    <form action="{{ route('admin.data-petugas.destroy', $item->id) }}"
                                        method="POST" class="inline"
                                        onsubmit="return confirm('Yakin hapus petugas ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button
                                            class="px-3 py-1 text-xs rounded-lg text-white
                                            bg-red-500 hover:bg-red-600 transition">
                                            Hapus
                                        </button>
                                    </form>

                                </td>

                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center py-6 text-gray-400">
                                    Data petugas kosong
                                </td>
                            </tr>
                            @endforelse
                        </tbody>

                    </table>
                </div>

                {{-- Pagination --}}
                <div class="mt-6">
                    {{ $petugas->links() }}
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
