<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="text-xl font-bold text-[#1F1F1E]">
                Verifikasi Data Buku
            </h2>
            <p class="text-sm text-gray-500 mt-1">
                Kelola dan verifikasi buku yang diajukan oleh petugas.
            </p>
        </div>
    </x-slot>

    <div class="py-8 bg-[#F4F4F2] min-h-screen">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Summary --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                {{-- Total Pending --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
                    <p class="text-sm text-gray-500">
                        Menunggu Verifikasi
                    </p>

                    <h3 class="text-2xl font-bold text-[#1F1F1E] mt-2">
                        {{ $dataBuku->count() }}
                    </h3>
                </div>

                {{-- Information --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 flex items-center">

                    <div>
                        <p class="text-sm text-gray-500">
                            Informasi
                        </p>

                        <p class="text-sm text-[#1F1F1E] mt-1">
                            Buku yang tampil di halaman ini adalah data yang menunggu persetujuan admin.
                        </p>
                    </div>

                </div>

            </div>

            {{-- Main Card --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">

                {{-- Top Section --}}
                <div class="px-6 py-5 border-b border-gray-100">

                    <div>
                        <h3 class="font-semibold text-[#1F1F1E]">
                            Daftar Buku Menunggu Verifikasi
                        </h3>

                        <p class="text-sm text-gray-500 mt-1">
                            Periksa detail buku sebelum menyetujui atau menolak data.
                        </p>
                    </div>

                </div>

                {{-- Table --}}
                <div class="overflow-x-auto">

                    <table class="min-w-full text-sm text-left">

                        <thead class="bg-[#1F1F1E] text-white">
                            <tr>
                                <th class="px-6 py-4 font-medium">
                                    Judul Buku
                                </th>

                                <th class="px-6 py-4 font-medium">
                                    Pengarang
                                </th>

                                <th class="px-6 py-4 font-medium">
                                    Tahun
                                </th>

                                <th class="px-6 py-4 font-medium">
                                    Status
                                </th>

                                <th class="px-6 py-4 font-medium text-center">
                                    Aksi
                                </th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-100">

                            @forelse ($dataBuku as $buku)

                                <tr class="hover:bg-gray-50 transition">

                                    {{-- Judul --}}
                                    <td class="px-6 py-5">
                                        <span class="font-semibold text-[#1F1F1E]">
                                            {{ $buku->judul_buku }}
                                        </span>
                                    </td>

                                    {{-- Pengarang --}}
                                    <td class="px-6 py-5 text-gray-600">
                                        {{ $buku->pengarang }}
                                    </td>

                                    {{-- Tahun --}}
                                    <td class="px-6 py-5 text-gray-600">
                                        {{ $buku->tahun_terbit }}
                                    </td>

                                    {{-- Status --}}
                                    <td class="px-6 py-5">
                                        <span class="inline-flex items-center
                                                     px-3 py-1 rounded-full
                                                     bg-yellow-100 text-yellow-700
                                                     text-xs font-medium">
                                            Menunggu Verifikasi
                                        </span>
                                    </td>

                                    {{-- Aksi --}}
                                    <td class="px-6 py-5 text-center">

                                        <a href="{{ route('admin.verifikasi-buku.detail', $buku->id) }}"
                                           class="px-4 py-2 rounded-xl
                                                  bg-[#3D3D3B] hover:bg-[#2A2A28]
                                                  text-white text-xs font-medium
                                                  transition shadow-sm">
                                            Detail
                                        </a>

                                    </td>

                                </tr>

                            @empty

                                <tr>
                                    <td colspan="5" class="py-16 text-center">

                                        <div class="flex flex-col items-center gap-2">

                                            <p class="text-gray-500 font-medium">
                                                Tidak ada buku yang menunggu verifikasi
                                            </p>

                                        </div>

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
