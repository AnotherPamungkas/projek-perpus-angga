<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Detail Riwayat Peminjaman</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
</head>

<body style="background-color: #f0f4f8;" class="min-h-screen py-8">

    <div class="max-w-5xl mx-auto px-6">

        <div class="bg-white rounded-2xl shadow-sm overflow-hidden">

            {{-- HEADER --}}
            <div class="px-8 py-5 flex items-center justify-between"
                style="background: linear-gradient(135deg, #1557b0 0%, #1a73e8 55%, #4da3ff 100%);">

                <a href="{{ route('peminjam.riwayat-peminjaman.index') }}"
                    class="flex items-center gap-2 text-white/90 hover:text-white transition group text-sm font-semibold">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-4 h-4 group-hover:-translate-x-1 transition-transform duration-200"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                    </svg>
                    Kembali
                </a>

                <div class="text-center">
                    <h1 class="text-white font-bold text-lg tracking-wide">Detail Riwayat Peminjaman</h1>
                    <p class="text-white/70 text-xs mt-0.5">Informasi lengkap peminjaman buku Anda</p>
                </div>

                <div class="w-16"></div>

            </div>

            {{-- BODY --}}
            <div class="p-8 grid md:grid-cols-3 gap-10">

                {{-- COVER --}}
                <div class="md:col-span-1">
                    <img src="{{ asset('storage/cover-buku/' . $peminjaman->buku->cover ?? 'default.jpg') }}"
                        class="w-full h-[340px] object-cover rounded-xl shadow-md">
                </div>

                {{-- DETAIL --}}
                <div class="md:col-span-2 space-y-6">

                    {{-- Informasi Buku --}}
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800 leading-snug">
                            {{ $peminjaman->buku->judul_buku }}
                        </h2>
                        <div class="flex flex-wrap gap-4 mt-2 text-sm text-gray-500">
                            <span class="flex items-center gap-1">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                {{ $peminjaman->buku->pengarang }}
                            </span>
                            <span class="flex items-center gap-1">
                                <svg class="w-4 h-4 text-[#1a73e8]" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M17.707 9.293a1 1 0 010 1.414l-7 7a1 1 0 01-1.414 0l-7-7A.997.997 0 012 10V5a3 3 0 013-3h5c.256 0 .512.098.707.293l7 7zM5 6a1 1 0 100-2 1 1 0 000 2z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span class="text-[#1a73e8] font-medium">
                                    {{ $peminjaman->buku->kategori->nama_kategori }}
                                </span>
                            </span>
                        </div>
                    </div>

                    {{-- Informasi Peminjaman --}}
                    <div class="bg-gray-50 p-5 rounded-xl border border-gray-100 space-y-4">

                        <h3 class="font-bold text-gray-700 text-sm">Informasi Peminjaman</h3>

                        <div class="grid grid-cols-2 gap-4 text-sm">

                            <div>
                                <p class="text-xs text-gray-400">Tanggal Pinjam</p>
                                <p class="font-semibold text-gray-700 mt-0.5">
                                    {{ \Carbon\Carbon::parse($peminjaman->tanggal_pinjam)->format('d M Y') }}
                                </p>
                            </div>

                            <div>
                                <p class="text-xs text-gray-400">Jatuh Tempo</p>
                                <p class="font-semibold text-gray-700 mt-0.5">
                                    {{ \Carbon\Carbon::parse($peminjaman->tanggal_jatuh_tempo)->format('d M Y') }}
                                </p>
                            </div>

                            <div>
                                <p class="text-xs text-gray-400">Tanggal Kembali</p>
                                <p class="font-semibold text-gray-700 mt-0.5">
                                    {{ \Carbon\Carbon::parse($peminjaman->tanggal_kembali)->format('d M Y') }}
                                </p>
                            </div>

                            <div>
                                <p class="text-xs text-gray-400">Status</p>
                                <div class="mt-0.5">
                                    @if($peminjaman->status === 'dikembalikan')
                                    <span class="px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700">
                                        ● Dikembalikan
                                    </span>
                                    @elseif($peminjaman->status === 'terlambat')
                                    <span class="px-3 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-600">
                                        ● Terlambat
                                    </span>
                                    @elseif($peminjaman->status === 'dipinjam')
                                    <span class="px-3 py-1 rounded-full text-xs font-semibold bg-blue-50 text-[#1a73e8]">
                                        ● Sedang Dipinjam
                                    </span>
                                    @elseif($peminjaman->status === 'menunggu_validasi')
                                    <span class="px-3 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-600">
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

                    {{-- ULASAN --}}
                    @if($peminjaman->tanggal_kembali)
                    <div class="bg-white border border-gray-100 rounded-xl p-5 shadow-sm">

                        <h3 class="font-bold text-gray-700 text-sm mb-4">Ulasan Anda</h3>

                        @if(!$ulasan)
                        <button onclick="openModal()"
                            class="flex items-center gap-2 px-5 py-2.5 rounded-xl font-semibold text-sm text-white shadow-sm transition hover:opacity-90"
                            style="background: linear-gradient(135deg, #1557b0 0%, #1a73e8 55%, #4da3ff 100%);">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                            </svg>
                            Beri Ulasan
                        </button>

                        @else

                        <div class="flex items-center gap-0.5 mb-2">
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= $ulasan->rating)
                                <span class="text-yellow-400 text-xl">★</span>
                                @else
                                <span class="text-gray-200 text-xl">★</span>
                                @endif
                            @endfor
                        </div>

                        <p class="text-gray-600 text-sm leading-relaxed">
                            {{ $ulasan->isi_ulasan }}
                        </p>

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

            {{-- Modal Header --}}
            <div class="px-6 py-5"
                style="background: linear-gradient(135deg, #1557b0 0%, #1a73e8 55%, #4da3ff 100%);">
                <h2 class="text-base font-bold text-white">Beri Ulasan</h2>
            </div>

            <div class="p-6">
                <form action="{{ route('peminjam.ulasan.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="buku_id" value="{{ $peminjaman->buku_id }}">

                    <div class="mb-5">
                        <label class="block mb-2 text-sm font-semibold text-gray-700">Rating</label>
                        <div class="flex space-x-1 text-3xl" id="starRating">
                            @for($i = 1; $i <= 5; $i++)
                            <span data-value="{{ $i }}" class="star cursor-pointer text-gray-200 transition hover:text-yellow-400">
                                ★
                            </span>
                            @endfor
                        </div>
                        <input type="hidden" name="rating" id="ratingValue" required>
                    </div>

                    <div class="mb-5">
                        <label class="block mb-2 text-sm font-semibold text-gray-700">Ulasan</label>
                        <textarea name="isi_ulasan" rows="4"
                            class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm bg-gray-50 focus:ring-2 focus:ring-[#1a73e8] focus:outline-none focus:bg-white transition"
                            placeholder="Tulis ulasan Anda..." required></textarea>
                    </div>

                    <div class="flex justify-end gap-3">
                        <button type="button" onclick="closeModal()"
                            class="px-5 py-2 rounded-xl text-sm font-semibold text-gray-600 bg-gray-100 hover:bg-gray-200 transition">
                            Batal
                        </button>
                        <button type="submit"
                            class="px-5 py-2 rounded-xl text-sm font-semibold text-white shadow-sm transition hover:opacity-90"
                            style="background: linear-gradient(135deg, #1557b0 0%, #1a73e8 55%, #4da3ff 100%);">
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
                        s.classList.remove('text-gray-200');
                        s.classList.add('text-yellow-400');
                    } else {
                        s.classList.remove('text-yellow-400');
                        s.classList.add('text-gray-200');
                    }
                });
            });

            star.addEventListener('mouseover', function () {
                const value = this.getAttribute('data-value');
                stars.forEach(s => {
                    if (s.getAttribute('data-value') <= value) {
                        s.classList.add('text-yellow-300');
                    }
                });
            });
        });
    </script>

</body>
</html>
