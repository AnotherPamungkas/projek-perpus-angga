<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Data Petugas
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="mb-4">
                <a href="{{ route('admin.data-petugas.create') }}"
                   class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                    + Tambah Petugas
                </a>
            </div>

            <div class="bg-white shadow rounded">
                <table class="w-full table-auto border-collapse">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="border px-4 py-2">No</th>
                            <th class="border px-4 py-2">Nama</th>
                            <th class="border px-4 py-2">Email</th>
                            <th class="border px-4 py-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($petugas as $item)
                        <tr>
                            <td class="border px-4 py-2 text-center">
                                {{ $loop->iteration }}
                            </td>
                            <td class="border px-4 py-2">
                                {{ $item->nama }}
                            </td>
                            <td class="border px-4 py-2">
                                {{ $item->email }}
                            </td>
                            <td class="border px-4 py-2 text-center space-x-2">
                                <a href="{{ route('admin.data-petugas.edit', $item->id) }}"
                                   class="px-3 py-1 bg-yellow-500 text-white rounded">
                                    Edit
                                </a>

                                <form action="{{ route('admin.data-petugas.destroy', $item->id) }}"
                                      method="POST"
                                      class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button onclick="return confirm('Yakin hapus petugas?')"
                                            class="px-3 py-1 bg-red-600 text-white rounded">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach

                        @if($petugas->count() === 0)
                        <tr>
                            <td colspan="4" class="text-center py-4 text-gray-500">
                                Data petugas kosong
                            </td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>
