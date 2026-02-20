<x-app-layout>
    <x-slot name="header">
        Data Kategori
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-4 bg-[#7AB2B2] text-white px-4 py-3 rounded-xl shadow">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white shadow-xl rounded-2xl p-6">

                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-semibold text-gray-700">
                        Daftar Kategori Buku
                    </h3>

                    <a href="{{ route('petugas.data-kategori.create') }}"
                        class="bg-[#09637E] hover:bg-[#088395] text-white px-5 py-2 rounded-lg shadow transition">
                        + Tambah Kategori
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left table-fixed">
                        <thead class="bg-[#09637E] text-white">
                            <tr>
                                <th class="px-4 py-3 w-16">No</th>
                                <th class="px-4 py-3 w-1/3">Nama Kategori</th>
                                <th class="px-4 py-3 w-1/3 text-center">Jumlah Buku</th>
                                <th class="px-4 py-3 w-1/3 text-center">Aksi</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-200">
                            @forelse($kategori as $item)
                            <tr class="hover:bg-[#EBF4F6] transition">

                                <td class="px-4 py-3">
                                    {{ $loop->iteration }}
                                </td>

                                <td class="px-4 py-3 font-medium">
                                    {{ $item->nama_kategori }}
                                </td>

                                <td class="px-4 py-3 text-center">
                                    <span class="px-3 py-1 rounded-full text-xs font-semibold
                                        {{ $item->buku_count > 0 ? 'bg-red-100 text-red-600' : 'bg-green-100 text-green-600' }}">
                                        {{ $item->buku_count }} Buku
                                    </span>
                                </td>

                                <td class="px-4 py-3 text-center space-x-2">

                                    <a href="{{ route('petugas.data-kategori.edit', $item->id) }}"
                                        class="bg-[#7AB2B2] hover:bg-[#088395] text-white px-3 py-1 rounded-lg transition">
                                        Edit
                                    </a>

                                    @if($item->buku_count > 0)
                                        <button disabled
                                            class="bg-gray-400 cursor-not-allowed text-white px-3 py-1 rounded-lg">
                                            Hapus
                                        </button>
                                    @else
                                        <form action="{{ route('petugas.data-kategori.destroy', $item->id) }}"
                                            method="POST"
                                            class="inline"
                                            onsubmit="return confirm('Yakin hapus kategori ini?')">
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
                                    <td colspan="4" class="text-center py-6 text-gray-500">
                                        Data kategori masih kosong
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>

                    </table>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
