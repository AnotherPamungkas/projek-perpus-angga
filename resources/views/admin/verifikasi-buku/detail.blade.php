<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="text-xl font-bold text-[#1F1F1E]">
                Detail Verifikasi Buku
            </h2>
            <p class="text-sm text-gray-500 mt-1">
                Tinjau detail buku sebelum menyetujui atau menolak pengajuan.
            </p>
        </div>
    </x-slot>

    <div class="py-8 bg-[#F4F4F2] min-h-screen">

        <div class="max-w-5xl mx-auto px-6 space-y-6">

            {{-- Main Card --}}
            <div class="bg-white rounded-3xl shadow-sm border border-gray-200 overflow-hidden">

                {{-- Header Card --}}
                <div class="px-8 py-6 border-b border-gray-100">
                    <h3 class="text-xl font-bold text-[#1F1F1E]">
                        Informasi Buku
                    </h3>
                    <p class="text-sm text-gray-500 mt-1">
                        Pastikan data buku valid sebelum dilakukan verifikasi.
                    </p>
                </div>

                <div class="p-8">

                    {{-- Cover + Basic Info --}}
                    <div class="grid md:grid-cols-3 gap-8">

                        {{-- Cover --}}
                        <div>
                            @if($buku->cover)
                                <img src="{{ asset('storage/cover-buku/'.$buku->cover) }}"
                                     class="w-full max-w-xs rounded-2xl shadow-sm border border-gray-200 object-cover">
                            @else
                                <div class="w-full h-64 rounded-2xl bg-gray-100 flex items-center justify-center text-gray-400 border border-gray-200">
                                    Tidak ada cover
                                </div>
                            @endif
                        </div>

                        {{-- Information --}}
                        <div class="md:col-span-2 grid md:grid-cols-2 gap-5">

                            {{-- Judul --}}
                            <div class="bg-gray-50 rounded-2xl p-5 border border-gray-100">
                                <p class="text-xs font-medium text-gray-500">
                                    Judul Buku
                                </p>
                                <p class="text-lg font-bold text-gray-800 mt-2">
                                    {{ $buku->judul_buku }}
                                </p>
                            </div>

                            {{-- Pengarang --}}
                            <div class="bg-gray-50 rounded-2xl p-5 border border-gray-100">
                                <p class="text-xs font-medium text-gray-500">
                                    Pengarang
                                </p>
                                <p class="text-lg font-bold text-gray-800 mt-2">
                                    {{ $buku->pengarang }}
                                </p>
                            </div>

                            {{-- Penerbit --}}
                            <div class="bg-gray-50 rounded-2xl p-5 border border-gray-100">
                                <p class="text-xs font-medium text-gray-500">
                                    Penerbit
                                </p>
                                <p class="text-lg font-bold text-gray-800 mt-2">
                                    {{ $buku->penerbit }}
                                </p>
                            </div>

                            {{-- Tahun Terbit --}}
                            <div class="bg-gray-50 rounded-2xl p-5 border border-gray-100">
                                <p class="text-xs font-medium text-gray-500">
                                    Tahun Terbit
                                </p>
                                <p class="text-lg font-bold text-gray-800 mt-2">
                                    {{ $buku->tahun_terbit }}
                                </p>
                            </div>

                            {{-- Jumlah --}}
                            <div class="bg-gray-50 rounded-2xl p-5 border border-gray-100">
                                <p class="text-xs font-medium text-gray-500">
                                    Jumlah Buku
                                </p>
                                <p class="text-lg font-bold text-gray-800 mt-2">
                                    {{ $buku->jumlah_buku }}
                                </p>
                            </div>

                            {{-- Status --}}
                            <div class="bg-gray-50 rounded-2xl p-5 border border-gray-100">
                                <p class="text-xs font-medium text-gray-500">
                                    Status
                                </p>

                                <div class="mt-2">
                                    <span class="inline-flex items-center
                                                 px-3 py-1 rounded-full
                                                 bg-yellow-100 text-yellow-700
                                                 text-xs font-medium">
                                        {{ ucfirst($buku->status) }}
                                    </span>
                                </div>
                            </div>

                        </div>

                    </div>

                    {{-- Description --}}
                    <div class="mt-8">
                        <div class="bg-gray-50 rounded-2xl p-6 border border-gray-100">
                            <p class="text-xs font-medium text-gray-500">
                                Deskripsi Buku
                            </p>

                            <p class="text-sm text-gray-700 mt-3 leading-relaxed">
                                {{ $buku->deskripsi ?? 'Tidak ada deskripsi.' }}
                            </p>
                        </div>
                    </div>

                    {{-- Actions --}}
                    <div class="flex justify-end gap-3 mt-8 pt-6 border-t border-gray-100">

                        <a href="{{ route('admin.verifikasi-buku.index') }}"
                           class="px-5 py-3 rounded-2xl border border-gray-300
                                  text-gray-700 text-sm font-medium
                                  hover:bg-gray-100 transition">
                            Kembali
                        </a>

                        <form action="{{ route('admin.verifikasi-buku.reject', $buku->id) }}"
                              method="POST">
                            @csrf

                            <button
                                class="px-5 py-3 rounded-2xl
                                       bg-red-500 hover:bg-red-600
                                       text-white text-sm font-medium transition">
                                Tolak
                            </button>
                        </form>

                        <form action="{{ route('admin.verifikasi-buku.verify', $buku->id) }}"
                              method="POST">
                            @csrf

                            <button
                                class="px-6 py-3 rounded-2xl
                                       bg-[#1F1F1E] hover:bg-[#2A2A28]
                                       text-white text-sm font-medium transition shadow-sm">
                                Setujui
                            </button>
                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>
</x-app-layout>
