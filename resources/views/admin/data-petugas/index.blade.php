<x-app-layout>
    <x-slot name="header">
        Manajemen Data Petugas
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Alert --}}
            @if(session('success'))
            <div class="mb-4 bg-[#7AB2B2] text-white px-4 py-3 rounded-xl shadow">
                {{ session('success') }}
            </div>
            @endif

            <div class="bg-white shadow-xl rounded-2xl p-6">

                <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-4 mb-6">

                    {{-- Search --}}
                    <form method="GET" class="flex gap-2">
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Cari nama / username / email..."
                            class="border border-[#7AB2B2] rounded-lg px-4 py-2 focus:ring-2 focus:ring-[#088395] focus:outline-none">

                        <button class="bg-[#09637E] text-white px-4 py-2 rounded-lg hover:bg-[#088395] transition">
                            Cari
                        </button>
                    </form>

                    <div class="flex gap-2">
                        <a href="{{ route('admin.data-petugas.create') }}"
                            class="bg-[#09637E] hover:bg-[#088395] text-white px-5 py-2 rounded-lg shadow transition">
                            + Tambah Petugas
                        </a>

                        <a href="{{ route('admin.data-petugas.export') }}"
                            class="bg-[#088395] hover:bg-[#09637E] text-white px-5 py-2 rounded-lg shadow transition">
                            Export Excel
                        </a>
                    </div>

                </div>


                {{-- Table --}}
                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm text-left">
                        <thead class="bg-[#09637E] text-white">
                            <tr>
                                <th class="px-4 py-3">No</th>
                                <th class="px-4 py-3">Nama</th>
                                <th class="px-4 py-3">Username</th>
                                <th class="px-4 py-3">Email</th>
                                <th class="px-4 py-3 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse($petugas as $index => $item)
                            <tr class="hover:bg-[#EBF4F6] transition">
                                <td class="px-4 py-3">
                                    {{ $petugas->firstItem() + $index }}
                                </td>
                                <td class="px-4 py-3 font-medium">
                                    {{ $item->nama }}
                                </td>
                                <td class="px-4 py-3">
                                    {{ $item->username }}
                                </td>
                                <td class="px-4 py-3">
                                    {{ $item->email }}
                                </td>
                                <td class="px-4 py-3 text-center space-x-2">

                                    <a href="{{ route('admin.data-petugas.edit', $item->id) }}"
                                        class="bg-[#7AB2B2] hover:bg-[#088395] text-white px-3 py-1 rounded-lg transition">
                                        Edit
                                    </a>

                                    <form action="{{ route('admin.data-petugas.destroy', $item->id) }}" method="POST"
                                        class="inline" onsubmit="return confirm('Yakin hapus petugas ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button
                                            class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg transition">
                                            Hapus
                                        </button>
                                    </form>

                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center py-6 text-gray-500">
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
