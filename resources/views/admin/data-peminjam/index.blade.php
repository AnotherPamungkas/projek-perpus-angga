<x-app-layout>
    <x-slot name="header">
        Manajemen Data Peminjam
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Success Alert --}}
            @if(session('success'))
                <div class="mb-4 bg-[#7AB2B2] text-white px-4 py-3 rounded-lg shadow">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Card --}}
            <div class="bg-white shadow-xl rounded-2xl p-6">

                {{-- Top Action --}}
                <div class="flex justify-between items-center mb-6">
                    <form method="GET" class="flex gap-2">
                        <input type="text"
                               name="search"
                               value="{{ request('search') }}"
                               placeholder="Cari nama..."
                               class="border border-[#7AB2B2] rounded-lg px-4 py-2 focus:ring-2 focus:ring-[#088395] focus:outline-none">

                        <button class="bg-[#09637E] text-white px-4 py-2 rounded-lg hover:bg-[#088395] transition">
                            Cari
                        </button>
                    </form>

                    <a href="{{ route('admin.data-peminjam.export') }}"
                       class="bg-[#088395] text-white px-5 py-2 rounded-lg shadow hover:bg-[#09637E] transition">
                        Export Excel
                    </a>
                </div>

                {{-- Table --}}
                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm text-left">
                        <thead class="bg-[#09637E] text-white">
                            <tr>
                                <th class="px-4 py-3">No</th>
                                <th class="px-4 py-3">Nama</th>
                                <th class="px-4 py-3">Email</th>
                                <th class="px-4 py-3">Telepon</th>
                                <th class="px-4 py-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse($dataPeminjam as $index => $peminjam)
                                <tr class="hover:bg-[#EBF4F6] transition">
                                    <td class="px-4 py-3">
                                        {{ $dataPeminjam->firstItem() + $index }}
                                    </td>
                                    <td class="px-4 py-3 font-medium">
                                        {{ $peminjam->nama }}
                                    </td>
                                    <td class="px-4 py-3">
                                        {{ $peminjam->email }}
                                    </td>
                                    <td class="px-4 py-3">
                                        {{ $peminjam->profil->nomor_telepon ?? '-' }}
                                    </td>
                                    <td class="px-4 py-3">
                                        <form method="POST"
                                              action="{{ route('admin.data-peminjam.destroy', $peminjam->id) }}"
                                              onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="bg-red-500 text-white px-3 py-1 rounded-lg hover:bg-red-600 transition">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-6 text-gray-500">
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
