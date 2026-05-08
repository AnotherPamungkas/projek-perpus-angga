<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Detail Validasi Peminjaman</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>

<body class="bg-[#F4F4F2] min-h-screen">

<div x-data="{ openModal: false }" class="py-10 px-4">

    <div class="max-w-6xl mx-auto">

        {{-- Header --}}
        <div class="mb-6 flex items-center justify-between">

            <a href="{{ route('petugas.validasi-peminjaman.index') }}"
                class="flex items-center gap-2 text-[#3D3D3B] hover:opacity-70 transition">

                <svg xmlns="http://www.w3.org/2000/svg"
                    class="h-5 w-5"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor">

                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M15 19l-7-7 7-7"/>

                </svg>

                <span class="text-sm font-medium">
                    Kembali ke Validasi
                </span>
            </a>

        </div>

        {{-- Main Card --}}
        <div class="bg-[#E8E8E8] border border-[#BBBFCA] rounded-3xl shadow-sm overflow-hidden">

            <div class="grid md:grid-cols-2 gap-8 p-8">

                {{-- Cover Section --}}
                <div>

                    <div class="overflow-hidden rounded-2xl border border-[#BBBFCA] shadow-sm">

                        <img
                            src="{{ $peminjaman->buku->cover
                                ? asset('storage/cover-buku/'.$peminjaman->buku->cover)
                                : asset('images/default-book.png') }}"
                            class="w-full h-[500px] object-cover">

                    </div>

                </div>

                {{-- Detail Section --}}
                <div class="space-y-6">

                    {{-- Title --}}
                    <div>
                        <p class="text-sm text-[#3D3D3B]/60">
                            Detail Validasi Buku
                        </p>

                        <h1 class="text-3xl font-bold text-[#3D3D3B] mt-2">
                            {{ $peminjaman->buku->judul_buku }}
                        </h1>

                        <p class="text-sm text-[#3D3D3B]/60 mt-2">
                            {{ $peminjaman->buku->kategori->nama_kategori }}
                        </p>
                    </div>

                    {{-- Informasi Peminjaman --}}
                    <div class="bg-[#F4F4F2] border border-[#BBBFCA] rounded-2xl p-5">

                        <h3 class="font-semibold text-[#3D3D3B] mb-4">
                            Informasi Peminjaman
                        </h3>

                        <div class="space-y-4 text-sm">

                            <div class="flex justify-between">
                                <span class="text-[#3D3D3B]/60">Nama Peminjam</span>
                                <span class="font-medium text-[#3D3D3B]">
                                    {{ $peminjaman->peminjam->nama }}
                                </span>
                            </div>

                            <div class="flex justify-between">
                                <span class="text-[#3D3D3B]/60">Username</span>
                                <span class="font-medium text-[#3D3D3B]">
                                    {{ $peminjaman->peminjam->username }}
                                </span>
                            </div>

                            <div class="flex justify-between">
                                <span class="text-[#3D3D3B]/60">Alamat</span>
                                <span class="font-medium text-[#3D3D3B]">
                                    {{ $peminjaman->peminjam->profil->alamat }}
                                </span>
                            </div>

                            <div class="flex justify-between">
                                <span class="text-[#3D3D3B]/60">Jumlah Dipinjam</span>
                                <span class="font-medium text-[#3D3D3B]">
                                    {{ $peminjaman->jumlah_dipinjam }}
                                </span>
                            </div>

                            <div class="flex justify-between">
                                <span class="text-[#3D3D3B]/60">Stok Tersedia</span>
                                <span class="font-medium text-[#3D3D3B]">
                                    {{ $peminjaman->buku->jumlah_buku }}
                                </span>
                            </div>

                        </div>

                    </div>

                    {{-- Riwayat --}}
                    <div class="bg-[#F4F4F2] border border-[#BBBFCA] rounded-2xl p-5">

                        <h3 class="font-semibold text-[#3D3D3B] mb-4">
                            Riwayat Peminjaman
                        </h3>

                        <div class="space-y-4 text-sm">

                            {{-- <div class="flex justify-between">
                                <span class="text-[#3D3D3B]/60">Riwayat Terlambat</span>

                                <span class="px-3 py-1 rounded-full text-xs font-semibold
                                    {{ $riwayatTerlambat > 0
                                        ? 'bg-red-100 text-red-600'
                                        : 'bg-green-100 text-green-600' }}">

                                    {{ $riwayatTerlambat }}x
                                </span>
                            </div> --}}

                            <div class="flex justify-between">
                                <span class="text-[#3D3D3B]/60">Tanggal Pinjam</span>
                                <span class="font-medium text-[#3D3D3B]">
                                    {{ \Carbon\Carbon::parse($peminjaman->tanggal_pinjam)->format('d M Y') }}
                                </span>
                            </div>

                            <div class="flex justify-between">
                                <span class="text-[#3D3D3B]/60">Jatuh Tempo</span>
                                <span class="font-medium text-[#3D3D3B]">
                                    {{ \Carbon\Carbon::parse($peminjaman->tanggal_jatuh_tempo)->format('d M Y') }}
                                </span>
                            </div>

                        </div>

                    </div>

                    {{-- Warning Stock --}}
                    @if($peminjaman->buku->jumlah_buku < $peminjaman->jumlah_dipinjam)
                        <div class="bg-red-50 border border-red-200 text-red-600 rounded-2xl p-4 text-sm">
                            Stok buku tidak mencukupi untuk jumlah yang dipinjam.
                        </div>
                    @endif

                    {{-- Action Buttons --}}
                    <div class="flex flex-col sm:flex-row gap-4 pt-2">

                        {{-- Reject --}}
                        <button
                            @click="openModal = true"
                            class="flex-1 py-3 rounded-2xl bg-red-500 hover:bg-red-600
                            text-white font-semibold shadow-sm transition-all duration-300">

                            Tolak Peminjaman
                        </button>

                        {{-- Approve --}}
                        <form action="{{ route('petugas.validasi-peminjaman.verify', $peminjaman->id) }}"
                            method="POST"
                            class="flex-1"
                            onsubmit="return confirm('Setujui peminjaman ini?')">

                            @csrf
                            @method('PUT')

                            <button
                                class="w-full py-3 rounded-2xl bg-[#3D3D3B]
                                hover:bg-[#1F1F1E]
                                text-white font-semibold shadow-sm
                                transition-all duration-300">

                                Setujui Peminjaman
                            </button>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

    {{-- Modal Penolakan --}}
    <div x-show="openModal"
        x-transition.opacity
        class="fixed inset-0 bg-black/50 flex items-center justify-center z-50 px-4">

        <div
            @click.away="openModal = false"
            class="bg-[#F4F4F2] w-full max-w-lg rounded-3xl shadow-xl border border-[#BBBFCA] overflow-hidden">

            {{-- Header --}}
            <div class="px-6 py-5 border-b border-[#BBBFCA]">

                <h3 class="text-lg font-bold text-[#3D3D3B]">
                    Alasan Penolakan
                </h3>

                <p class="text-sm text-[#3D3D3B]/60 mt-1">
                    Jelaskan alasan penolakan peminjaman ini.
                </p>

            </div>

            {{-- Content --}}
            <div class="p-6">

                <form action="{{ route('petugas.validasi-peminjaman.reject', $peminjaman->id) }}"
                    method="POST">

                    @csrf
                    @method('PUT')

                    <textarea
                        name="alasan_penolakan"
                        required
                        rows="5"
                        placeholder="Tuliskan alasan penolakan..."
                        class="w-full rounded-2xl border border-[#BBBFCA]
                        bg-white px-4 py-3 text-sm
                        focus:border-[#3D3D3B]
                        focus:ring-0
                        resize-none"></textarea>

                    {{-- Actions --}}
                    <div class="flex justify-end gap-3 mt-6">

                        <button
                            type="button"
                            @click="openModal = false"
                            class="px-5 py-2 rounded-xl bg-[#E8E8E8]
                            text-[#3D3D3B] hover:bg-[#DADADA]
                            transition-all duration-300">

                            Batal
                        </button>

                        <button
                            class="px-5 py-2 rounded-xl bg-red-500
                            hover:bg-red-600 text-white font-medium
                            transition-all duration-300">

                            Tolak Peminjaman
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>

</body>
</html>
