<x-app-layout>
    <x-slot name="header">
        <div class="bg-[#3D3D3B] rounded-2xl px-8 py-6 shadow-sm">
            <h1 class="text-2xl font-bold text-white">
                Data Kategori
            </h1>
            <p class="text-sm text-[#D6D3D1] mt-1">
                Kelola kategori buku perpustakaan
            </p>
        </div>
    </x-slot>

    <div class="py-8 bg-[#F5F5F4] min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Success Message --}}
            @if(session('success'))
                <div class="mb-6 bg-[#3D3D3B] text-white px-5 py-4 rounded-2xl shadow-sm">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white shadow-sm rounded-2xl border border-[#E7E5E4] overflow-hidden">

                {{-- Top Action --}}
                <div class="px-6 py-5 border-b border-[#E7E5E4] flex justify-between items-center">

                    <div>
                        <h3 class="text-lg font-semibold text-[#1F1F1E]">
                            Daftar Kategori Buku
                        </h3>
                        <p class="text-sm text-[#78716C]">
                            Total {{ $kategori->count() }} kategori
                        </p>
                    </div>

                    <a href="{{ route('petugas.data-kategori.create') }}"
                        class="px-5 py-2.5 rounded-xl bg-[#1F1F1E] hover:bg-[#3D3D3B] text-white font-medium transition">
                        + Tambah Kategori
                    </a>

                </div>

                {{-- Table --}}
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">

                        <thead class="bg-[#1F1F1E] text-white">
                            <tr>
                                <th class="px-6 py-4 text-left">No</th>
                                <th class="px-6 py-4 text-left">Nama Kategori</th>
                                <th class="px-6 py-4 text-center">Jumlah Buku</th>
                                <th class="px-6 py-4 text-center">Aksi</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-[#E7E5E4]">

                            @forelse($kategori as $item)
                            <tr class="hover:bg-[#F9F9F8] transition">

                                <td class="px-6 py-4">
                                    {{ $loop->iteration }}
                                </td>

                                <td class="px-6 py-4 font-medium text-[#1F1F1E]">
                                    {{ $item->nama_kategori }}
                                </td>

                                <td class="px-6 py-4 text-center">
                                    <span class="px-3 py-1 rounded-full text-xs font-semibold
                                        {{ $item->buku_count > 0
                                            ? 'bg-red-50 text-red-600'
                                            : 'bg-green-50 text-green-600' }}">
                                        {{ $item->buku_count }} Buku
                                    </span>
                                </td>

                                <td class="px-6 py-4 text-center">
                                    <div class="flex justify-center gap-2">

                                        <a href="{{ route('petugas.data-kategori.edit', $item->id) }}"
                                            class="px-4 py-2 rounded-xl bg-[#3D3D3B] hover:bg-[#1F1F1E] text-white transition">
                                            Edit
                                        </a>

                                        @if($item->buku_count > 0)

                                            <button disabled
                                                class="px-4 py-2 rounded-xl bg-gray-300 text-gray-500 cursor-not-allowed">
                                                Hapus
                                            </button>

                                        @else

                                            <form action="{{ route('petugas.data-kategori.destroy', $item->id) }}"
                                                method="POST"
                                                onsubmit="return confirm('Yakin hapus kategori ini?')">
                                                @csrf
                                                @method('DELETE')

                                                <button
                                                    class="px-4 py-2 rounded-xl bg-red-500 hover:bg-red-600 text-white transition">
                                                    Hapus
                                                </button>
                                            </form>

                                        @endif

                                    </div>
                                </td>

                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center py-10 text-[#78716C]">
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
