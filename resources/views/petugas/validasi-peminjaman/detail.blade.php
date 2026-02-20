<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Validasi</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>

<body class="bg-[#EBF4F6] min-h-screen">

<div x-data="{ openModal: false }" class="py-10">

<div class="max-w-5xl mx-auto bg-white shadow-2xl rounded-2xl p-8">

    {{-- HEADER --}}
    <div class="flex items-center justify-between mb-8">

        <a href="{{ route('petugas.validasi-peminjaman.index') }}"
           class="flex items-center gap-2 text-[#09637E] hover:text-[#088395] transition">

            {{-- Arrow Back SVG --}}
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

            <span class="text-sm font-medium">Kembali</span>
        </a>

    </div>

    {{-- CONTENT --}}
    <div class="grid md:grid-cols-2 gap-10">

        {{-- COVER --}}
        <div>
            <img src="{{ asset('storage/'.$peminjaman->buku->cover) }}"
                 class="rounded-xl shadow-lg w-full">
        </div>

        {{-- INFO --}}
        <div class="space-y-4 text-sm text-gray-700">

            <h2 class="text-2xl font-bold text-[#09637E]">
                {{ $peminjaman->buku->judul_buku }}
            </h2>

            <div class="bg-[#EBF4F6] rounded-xl p-4 space-y-2">

                <p><strong>Peminjam:</strong> {{ $peminjaman->peminjam->nama }}</p>
                <p><strong>Username:</strong> {{ $peminjaman->peminjam->username }}</p>
                <p><strong>Jumlah Dipinjam:</strong> {{ $peminjaman->jumlah_dipinjam }}</p>
                <p><strong>Stok Tersedia:</strong> {{ $peminjaman->buku->jumlah_buku }}</p>
                <p><strong>Riwayat Terlambat:</strong> {{ $riwayatTerlambat }}x</p>

                <hr class="my-3">

                <p><strong>Tanggal Pinjam:</strong> {{ \Carbon\Carbon::parse($peminjaman->tanggal_pinjam)->format('d M Y') }}</p>
                <p><strong>Tanggal Jatuh Tempo:</strong> {{ \Carbon\Carbon::parse($peminjaman->tanggal_jatuh_tempo)->format('d M Y') }}</p>

            </div>

            {{-- BUTTON SECTION --}}
            <div class="flex gap-6 items-center mt-6">

                {{-- Reject --}}
                <button
                    @click="openModal = true"
                    class="bg-red-500 hover:bg-red-600 text-white px-6 py-2 rounded-lg transition shadow">
                    Tolak
                </button>

                {{-- Approve --}}
                <form action="{{ route('petugas.validasi-peminjaman.verify',$peminjaman->id) }}"
                      method="POST"
                      onsubmit="return confirm('Setujui peminjaman ini?')">
                    @csrf
                    @method('PUT')

                    <button
                        class="bg-[#09637E] hover:bg-[#088395] text-white px-6 py-2 rounded-lg transition shadow">
                        Setujui
                    </button>
                </form>

            </div>

        </div>
    </div>

</div>

{{-- MODAL --}}
<div x-show="openModal"
     x-transition.opacity
     class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">

    <div class="bg-white w-full max-w-md rounded-2xl shadow-2xl p-6"
         @click.away="openModal = false">

        <h3 class="text-lg font-semibold text-[#09637E] mb-4">
            Alasan Penolakan
        </h3>

        <form action="{{ route('petugas.validasi-peminjaman.reject',$peminjaman->id) }}"
              method="POST">
            @csrf
            @method('PUT')

            <textarea name="alasan_penolakan"
                      required
                      rows="4"
                      placeholder="Tuliskan alasan penolakan..."
                      class="w-full border border-[#7AB2B2] rounded-lg px-4 py-2 focus:ring-2 focus:ring-[#088395] focus:outline-none text-sm"></textarea>

            <div class="flex justify-end gap-3 mt-5">

                <button type="button"
                        @click="openModal = false"
                        class="px-4 py-2 bg-gray-400 hover:bg-gray-500 text-white rounded-lg">
                    Batal
                </button>

                <button
                    class="px-5 py-2 bg-red-500 hover:bg-red-600 text-white rounded-lg shadow">
                    Tolak Peminjaman
                </button>

            </div>
        </form>

    </div>
</div>

</div>
</body>
</html>
