<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-[#1557b0]">
            Manajemen Data Peminjam
        </h2>
    </x-slot>

    <div class="py-8 min-h-screen
        bg-gradient-to-br from-[#eaf2ff] via-white to-[#d6e6ff]">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Success Alert --}}
            @if(session('success'))
                <div class="bg-blue-50 border border-blue-200 text-[#1557b0] px-4 py-3 rounded-xl shadow-sm">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Card --}}
            <div class="bg-white shadow-sm rounded-2xl p-6 border border-blue-100">

                {{-- Top Action --}}
                <div class="flex flex-col sm:flex-row justify-between gap-4 mb-6">

                    <form method="GET" class="flex gap-2 w-full sm:w-auto">
                        <input type="text"
                               name="search"
                               value="{{ request('search') }}"
                               placeholder="Cari nama..."
                               class="border border-gray-200 rounded-lg px-4 py-2 text-sm
                               focus:ring-2 focus:ring-[#1a73e8] focus:border-[#1a73e8] focus:outline-none w-full sm:w-64">

                        <button class="px-4 py-2 rounded-lg text-white text-sm
                            bg-gradient-to-r from-[#1557b0] to-[#1a73e8]
                            hover:from-[#144a96] hover:to-[#1666cc] transition">
                            Cari
                        </button>
                    </form>

                    <a href="{{ route('admin.data-peminjam.export') }}"
                       class="px-5 py-2 rounded-lg text-white text-sm shadow-sm
                       bg-gradient-to-r from-[#1557b0] to-[#1a73e8]
                       hover:from-[#144a96] hover:to-[#1666cc] transition text-center">
                        Export Excel
                    </a>

                </div>

                {{-- Table --}}
                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm text-left">

                        <thead>
                            <tr class="text-white
                                bg-gradient-to-r from-[#1557b0] to-[#1a73e8]">
                                <th class="px-4 py-3">No</th>
                                <th class="px-4 py-3">Nama</th>
                                <th class="px-4 py-3">Email</th>
                                <th class="px-4 py-3">Telepon</th>
                                <th class="px-4 py-3">Aksi</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-100">
                            @forelse($dataPeminjam as $index => $peminjam)
                                <tr class="hover:bg-blue-50 transition">
                                    <td class="px-4 py-3">
                                        {{ $dataPeminjam->firstItem() + $index }}
                                    </td>

                                    <td class="px-4 py-3 font-medium text-gray-700">
                                        {{ $peminjam->nama }}
                                    </td>

                                    <td class="px-4 py-3 text-gray-600">
                                        {{ $peminjam->email }}
                                    </td>

                                    <td class="px-4 py-3 text-gray-600">
                                        {{ $peminjam->profil->nomor_telepon ?? '-' }}
                                    </td>

                                    <td class="px-4 py-3">
                                        <form method="POST"
                                              action="{{ route('admin.data-peminjam.destroy', $peminjam->id) }}"
                                              onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                            @csrf
                                            @method('DELETE')

                                            <button class="px-3 py-1 text-xs rounded-lg text-white
                                                bg-red-500 hover:bg-red-600 transition">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-6 text-gray-400">
                                        Tidak ada data peminjam.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>

                    </table>
                </div>

                {{-- Pagination --}}
                <div class="mt-6">
                    {{ $dataPeminjam->links() }}
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
