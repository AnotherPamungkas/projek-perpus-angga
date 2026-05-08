<x-app-layout>
    <div class="max-w-4xl mx-auto py-8 px-6">

        {{-- Main Card --}}
        <div class="bg-white rounded-3xl shadow-sm border border-[#BBBFCA] overflow-hidden">

            {{-- Header --}}
            <div class="px-6 py-5 bg-[#3D3D3B] flex items-center justify-between">
                <div>
                    <h2 class="text-white font-bold text-lg">
                        Konfirmasi Pembayaran Denda
                    </h2>

                    <p class="text-sm text-white/70 mt-1">
                        Pastikan detail pembayaran sudah sesuai.
                    </p>
                </div>
            </div>

            <div class="p-8 space-y-8">

                {{-- Informasi Buku --}}
                <div>
                    <h3 class="font-bold text-[#3D3D3B] mb-4">
                        Informasi Buku
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                        <div class="bg-[#F4F4F2] border border-[#BBBFCA] rounded-2xl p-4">
                            <p class="text-xs text-gray-500">
                                Judul Buku
                            </p>

                            <p class="font-semibold mt-2">
                                {{ $peminjaman->buku->judul_buku }}
                            </p>
                        </div>

                        <div class="bg-[#F4F4F2] border border-[#BBBFCA] rounded-2xl p-4">
                            <p class="text-xs text-gray-500">
                                Nama Peminjam
                            </p>

                            <p class="font-semibold mt-2">
                                {{ auth()->user()->nama }}
                            </p>
                        </div>

                    </div>
                </div>

                {{-- Detail Peminjaman --}}
                <div>
                    <h3 class="font-bold text-[#3D3D3B] mb-4">
                        Detail Peminjaman
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                        <div class="bg-[#F4F4F2] border border-[#BBBFCA] rounded-2xl p-4">
                            <p class="text-xs text-gray-500">
                                Tanggal Pinjam
                            </p>

                            <p class="font-semibold mt-2">
                                {{ \Carbon\Carbon::parse($peminjaman->tanggal_pinjam)->format('d M Y') }}
                            </p>
                        </div>

                        <div class="bg-[#F4F4F2] border border-[#BBBFCA] rounded-2xl p-4">
                            <p class="text-xs text-gray-500">
                                Jatuh Tempo
                            </p>

                            <p class="font-semibold mt-2">
                                {{ \Carbon\Carbon::parse($peminjaman->tanggal_jatuh_tempo)->format('d M Y') }}
                            </p>
                        </div>

                    </div>
                </div>

                {{-- Detail Denda --}}
                <div>
                    <h3 class="font-bold text-[#3D3D3B] mb-4">
                        Rincian Denda
                    </h3>

                    <div class="space-y-4">

                        <div class="flex justify-between border-b border-[#BBBFCA] pb-3">
                            <span class="text-sm text-gray-500">
                                Hari Keterlambatan
                            </span>

                            <span class="font-semibold">
                                @php
                                $hariTerlambat = max(
                                0,
                                \Carbon\Carbon::parse($peminjaman->tanggal_jatuh_tempo)
                                ->startOfDay()
                                ->diffInDays(
                                now()->startOfDay(),
                                false
                                )
                                );
                                @endphp

                                {{ $hariTerlambat }} Hari
                            </span>
                        </div>

                        <div class="flex justify-between border-b border-[#BBBFCA] pb-3">
                            <span class="text-sm text-gray-500">
                                Tarif per Hari
                            </span>

                            <span class="font-semibold">
                                Rp {{ number_format(config('library.denda_per_hari'), 0, ',', '.') }}
                            </span>
                        </div>

                        <div class="flex justify-between border-b border-[#BBBFCA] pb-3">
                            <span class="text-sm text-gray-500">
                                Metode Pembayaran
                            </span>

                            <span class="font-semibold">
                                QR Payment Simulation
                            </span>
                        </div>

                        <div class="flex justify-between pt-2">
                            <span class="text-base font-bold text-[#3D3D3B]">
                                Total Denda
                            </span>

                            <span class="text-2xl font-bold text-red-500">
                                Rp {{ number_format($peminjaman->denda, 0, ',', '.') }}
                            </span>
                        </div>

                    </div>
                </div>

                {{-- Status --}}
                <div class="bg-yellow-50 border border-yellow-200 rounded-2xl p-5">
                    <p class="text-sm font-semibold text-yellow-700">
                        Status Pembayaran:
                        {{ ucwords(str_replace('_', ' ', $peminjaman->status_pembayaran)) }}
                    </p>
                </div>

                {{-- Action --}}
                <form method="POST" action="{{ route('peminjam.pembayaran.bayar', $peminjaman->id) }}">
                    @csrf

                    <button
                        class="w-full py-4 rounded-2xl bg-[#3D3D3B] text-white font-semibold hover:opacity-90 transition">
                        Simulasikan Pembayaran Sekarang
                    </button>
                </form>

            </div>

        </div>

    </div>
</x-app-layout>
