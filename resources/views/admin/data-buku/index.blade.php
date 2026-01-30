<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Data Buku
        </h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">

        @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('admin.data-buku.create') }}"
           class="mb-4 inline-block px-4 py-2 bg-blue-600 text-white rounded">
            + Tambah Buku
        </a>

        <div class="bg-white shadow rounded overflow-x-auto">
            <table class="w-full border">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="border px-3 py-2">No</th>
                        <th class="border px-3 py-2">Judul</th>
                        <th class="border px-3 py-2">Kategori</th>
                        <th class="border px-3 py-2">Jumlah</th>
                        <th class="border px-3 py-2">Status</th>
                        <th class="border px-3 py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($buku as $item)
                    <tr>
                        <td class="border px-3 py-2 text-center">{{ $loop->iteration }}</td>
                        <td class="border px-3 py-2">{{ $item->judul_buku }}</td>
                        <td class="border px-3 py-2">{{ $item->kategori->nama_kategori }}</td>
                        <td class="border px-3 py-2 text-center">{{ $item->jumlah_buku }}</td>
                        <td class="border px-3 py-2 text-center">
                            <span class="px-2 py-1 rounded text-white
                                {{ $item->status === 'tersedia' ? 'bg-green-600' : 'bg-red-600' }}">
                                {{ ucfirst($item->status) }}
                            </span>
                        </td>
                        <td class="border px-3 py-2 text-center space-x-2">
                            <a href="{{ route('admin.data-buku.edit', $item->id) }}"
                               class="px-3 py-1 bg-yellow-500 text-white rounded">Edit</a>

                            <form action="{{ route('admin.data-buku.destroy', $item->id) }}"
                                  method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Hapus buku ini?')"
                                        class="px-3 py-1 bg-red-600 text-white rounded">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-4 text-gray-500">
                            Data buku kosong
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
