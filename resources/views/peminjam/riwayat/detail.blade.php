<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Detail Riwayat Peminjaman</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
</head>

<body class="min-h-screen bg-[#F4F4F2]">

    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <div class="space-y-6">

            {{-- HEADER --}}
            <div class="bg-[#3D3D3B] rounded-2xl shadow-sm border border-[#BBBFCA] p-6">

                <div class="flex items-center justify-between">

                    <a href="{{ route('peminjam.riwayat-peminjaman.index') }}"
                        class="flex items-center gap-2 text-white/80 hover:text-white transition text-sm font-semibold group">

                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="w-4 h-4 group-hover:-translate-x-1 transition-transform" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                        </svg>

                        Kembali
                    </a>

                    <div class="text-center">
                        <h1 class="text-lg font-bold text-white">
                            Detail Riwayat Peminjaman
                        </h1>
                        <p class="text-xs text-white/70 mt-1">
                            Informasi lengkap transaksi peminjaman buku
                        </p>
                    </div>

                    <div class="w-16"></div>

                </div>

            </div>

            {{-- MAIN CONTENT --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                {{-- LEFT SIDE --}}
                <div class="space-y-5">

                    {{-- Cover Card --}}
                    <div
                        class="bg-white rounded-2xl shadow-sm border border-[#BBBFCA] overflow-hidden lg:sticky lg:top-6">

                        <img src="{{ $peminjaman->buku->cover
                            ? asset('storage/cover-buku/' . $peminjaman->buku->cover)
                            : asset('images/default-book.png') }}" class="w-full h-[420px] object-cover">

                        <div class="p-5">

                            <h2 class="font-bold text-[#3D3D3B] text-lg leading-snug">
                                {{ $peminjaman->buku->judul_buku }}
                            </h2>

                            <p class="text-sm text-gray-500 mt-2">
                                {{ $peminjaman->buku->pengarang }}
                            </p>

                            <div class="mt-4">
                                <span
                                    class="inline-flex px-3 py-1 rounded-full text-xs font-semibold bg-[#E8E8E8] text-[#3D3D3B]">
                                    {{ $peminjaman->buku->kategori->nama_kategori }}
                                </span>
                            </div>

                        </div>

                    </div>

                </div>

                {{-- RIGHT SIDE --}}
                <div class="lg:col-span-2 space-y-6">

                    {{-- Status Section --}}
                    <div class="bg-white rounded-2xl shadow-sm border border-[#BBBFCA] p-6">

                        <div class="flex items-center justify-between">

                            <div>
                                <p class="text-sm text-gray-500">
                                    Status Peminjaman
                                </p>

                                <div class="mt-2">
                                    @if($peminjaman->status === 'dikembalikan')
                                    <span
                                        class="px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700">
                                        ● Dikembalikan
                                    </span>
                                    @elseif($peminjaman->status === 'terlambat')
                                    <span class="px-3 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-600">
                                        ● Terlambat
                                    </span>
                                    @elseif($peminjaman->status === 'dipinjam')
                                    <span
                                        class="px-3 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-700">
                                        ● Sedang Dipinjam
                                    </span>
                                    @elseif($peminjaman->status === 'menunggu_validasi')
                                    <span
                                        class="px-3 py-1 rounded-full text-xs font-semibold bg-[#E8E8E8] text-[#3D3D3B]">
                                        ● Menunggu Validasi
                                    </span>
                                    @else
                                    <span class="px-3 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-600">
                                        ● Ditolak
                                    </span>
                                    @endif
                                </div>
                            </div>

                        </div>

                    </div>

                    {{-- Alasan Penolakan --}}
                    @if($peminjaman->status === 'ditolak' && $peminjaman->alasan_penolakan)
                    <div class="bg-white rounded-2xl shadow-sm border border-red-200 p-6">

                        <div class="flex items-start gap-4">

                            {{-- Icon --}}
                            <div class="w-10 h-10 rounded-xl bg-red-50 flex items-center justify-center shrink-0">

                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-red-500" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 9v2m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z" />
                                </svg>

                            </div>

                            {{-- Content --}}
                            <div class="flex-1">

                                <h3 class="text-base font-bold text-[#3D3D3B]">
                                    Alasan Penolakan
                                </h3>

                                <p class="text-sm text-gray-500 mt-1">
                                    Permintaan peminjaman ini ditolak oleh petugas.
                                </p>

                                <div class="mt-4 bg-[#F4F4F2] border border-red-100 rounded-xl p-4">

                                    <p class="text-sm text-[#3D3D3B] leading-relaxed">
                                        {{ $peminjaman->alasan_penolakan }}
                                    </p>

                                </div>

                            </div>

                        </div>

                    </div>
                    @endif

                    {{-- Informasi Peminjaman --}}
                    <div class="bg-white rounded-2xl shadow-sm border border-[#BBBFCA] p-6">

                        <h3 class="text-base font-bold text-[#3D3D3B] mb-5">
                            Informasi Peminjaman
                        </h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                            <div class="bg-[#F4F4F2] border border-[#BBBFCA] rounded-xl p-4">
                                <p class="text-xs text-gray-500">
                                    Tanggal Pinjam
                                </p>
                                <p class="font-semibold text-[#3D3D3B] mt-2">
                                    {{ \Carbon\Carbon::parse($peminjaman->tanggal_pinjam)->format('d M Y') }}
                                </p>
                            </div>

                            <div class="bg-[#F4F4F2] border border-[#BBBFCA] rounded-xl p-4">
                                <p class="text-xs text-gray-500">
                                    Jatuh Tempo
                                </p>
                                <p class="font-semibold text-[#3D3D3B] mt-2">
                                    {{ \Carbon\Carbon::parse($peminjaman->tanggal_jatuh_tempo)->format('d M Y') }}
                                </p>
                            </div>

                            <div class="bg-[#F4F4F2] border border-[#BBBFCA] rounded-xl p-4 md:col-span-2">
                                <p class="text-xs text-gray-500">
                                    Tanggal Kembali
                                </p>

                                <p class="font-semibold text-[#3D3D3B] mt-2">
                                    @if($peminjaman->tanggal_kembali)
                                    {{ \Carbon\Carbon::parse($peminjaman->tanggal_kembali)->format('d M Y') }}
                                    @else
                                    -
                                    @endif
                                </p>
                            </div>

                        </div>

                    </div>

                    {{-- ULASAN --}}
                    @if($peminjaman->tanggal_kembali)
                    <div class="bg-white rounded-2xl shadow-sm border border-[#BBBFCA] p-6">

                        <div class="flex items-center justify-between mb-5">

                            <h3 class="text-base font-bold text-[#3D3D3B]">
                                Ulasan Buku
                            </h3>

                            @if(!$ulasan)
                            <button onclick="openModal()"
                                class="px-5 py-2 rounded-xl bg-[#3D3D3B] text-white text-sm font-semibold hover:bg-[#2F2F2D] transition">
                                Beri Ulasan
                            </button>
                            @endif

                        </div>

                        @if($ulasan)

                        <div class="flex items-center gap-1 mb-4">
                            @for($i = 1; $i <= 5; $i++) @if($i <=$ulasan->rating)
                                <span class="text-yellow-400 text-2xl">★</span>
                                @else
                                <span class="text-gray-300 text-2xl">★</span>
                                @endif
                                @endfor
                        </div>

                        <div class="bg-[#F4F4F2] border border-[#BBBFCA] rounded-xl p-4">

                            <p class="text-sm text-[#3D3D3B] leading-relaxed">
                                {{ $ulasan->isi_ulasan }}
                            </p>

                        </div>

                        @else

                        <div class="bg-[#F4F4F2] border border-dashed border-[#BBBFCA] rounded-xl p-6 text-center">

                            <p class="text-sm text-gray-500">
                                Kamu belum memberikan ulasan untuk buku ini.
                            </p>

                        </div>

                        @endif

                    </div>
                    @endif

                </div>

            </div>

        </div>

    </div>

    {{-- MODAL ULASAN --}}
    <div id="reviewModal" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50 px-4">

        <div class="bg-white w-full max-w-md rounded-2xl shadow-xl overflow-hidden">

            {{-- Header --}}
            <div class="bg-[#3D3D3B] px-6 py-5">
                <h2 class="text-white font-bold text-base">
                    Beri Ulasan
                </h2>
            </div>

            {{-- Content --}}
            <div class="p-6">

                <form action="{{ route('peminjam.ulasan.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="buku_id" value="{{ $peminjaman->buku_id }}">

                    {{-- Rating --}}
                    <div class="mb-5">

                        <label class="block text-sm font-semibold text-[#3D3D3B] mb-3">
                            Rating
                        </label>

                        <div class="flex gap-2 text-3xl" id="starRating">
                            @for($i = 1; $i <= 5; $i++) <span data-value="{{ $i }}"
                                class="star cursor-pointer text-gray-300 transition">
                                ★
                                </span>
                                @endfor
                        </div>

                        <input type="hidden" name="rating" id="ratingValue" required>

                    </div>

                    {{-- Ulasan --}}
                    <div class="mb-5">

                        <label class="block text-sm font-semibold text-[#3D3D3B] mb-2">
                            Ulasan
                        </label>

                        <textarea name="isi_ulasan" rows="4"
                            class="w-full border border-[#BBBFCA] rounded-xl px-4 py-3 text-sm bg-[#F4F4F2] focus:ring-2 focus:ring-gray-500 focus:outline-none"
                            placeholder="Tulis ulasan Anda..." required></textarea>

                    </div>

                    {{-- Action --}}
                    <div class="flex justify-end gap-3">

                        <button type="button" onclick="closeModal()"
                            class="px-5 py-2 rounded-xl text-sm font-semibold bg-[#E8E8E8] text-[#3D3D3B] hover:bg-[#DCDCDC] transition">
                            Batal
                        </button>

                        <button type="submit"
                            class="px-5 py-2 rounded-xl text-sm font-semibold bg-[#3D3D3B] text-white hover:bg-[#2F2F2D] transition">
                            Simpan
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

    {{-- FOOTER --}}
    <div class="text-center text-xs text-gray-400 py-6">
        © {{ date('Y') }} Sistem Perpustakaan
    </div>

    <script>
        function openModal() {
            document.getElementById('reviewModal').classList.remove('hidden');
            document.getElementById('reviewModal').classList.add('flex');
        }

        function closeModal() {
            document.getElementById('reviewModal').classList.add('hidden');
            document.getElementById('reviewModal').classList.remove('flex');
        }

        const stars = document.querySelectorAll('.star');
        const ratingInput = document.getElementById('ratingValue');

        stars.forEach(star => {
            star.addEventListener('click', function () {
                const value = this.getAttribute('data-value');
                ratingInput.value = value;

                stars.forEach(s => {
                    if (s.getAttribute('data-value') <= value) {
                        s.classList.remove('text-gray-300');
                        s.classList.add('text-yellow-400');
                    } else {
                        s.classList.remove('text-yellow-400');
                        s.classList.add('text-gray-300');
                    }
                });
            });
        });

    </script>

</body>

</html>
