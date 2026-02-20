<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Detail Riwayat Peminjaman</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @vite('resources/css/app.css')
</head>

<body class="bg-[#EBF4F6] min-h-screen py-12">

    <div class="max-w-5xl mx-auto bg-white shadow-xl rounded-3xl overflow-hidden border border-[#7AB2B2]/30">

        <!-- HEADER -->
        <div class="bg-gradient-to-r from-[#09637E] to-[#088395] text-white px-8 py-6 flex items-center gap-4">

            <a href="{{ route('peminjam.riwayat-peminjaman.index') }}"
                class="hover:bg-white/20 p-2 rounded-full transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </a>

            <div>
                <h1 class="text-2xl font-bold tracking-wide">
                    Detail Riwayat Peminjaman
                </h1>
                <p class="text-sm opacity-90">
                    Informasi lengkap peminjaman buku Anda
                </p>
            </div>
        </div>

        <div class="p-8 grid md:grid-cols-3 gap-10">

            <!-- COVER -->
            <div class="aspect-[2/3] w-full overflow-hidden rounded-2xl shadow-lg ring-1 ring-[#7AB2B2]/30">
                <img src="{{ asset('storage/' . $peminjaman->buku->cover ?? 'default.jpg') }}"
                    class="w-full h-full object-cover object-center">
            </div>

            <!-- DETAIL -->
            <div class="md:col-span-2 space-y-8">

                <!-- Informasi Buku -->
                <div>
                    <h2 class="text-2xl font-bold text-[#09637E] mb-2">
                        {{ $peminjaman->buku->judul_buku }}
                    </h2>
                    <p class="text-gray-600">
                        <span class="font-semibold text-[#088395]">Penulis:</span>
                        {{ $peminjaman->buku->pengarang }}
                    </p>
                    <p class="text-gray-600">
                        <span class="font-semibold text-[#088395]">Kategori:</span>
                        {{ $peminjaman->buku->kategori->nama_kategori }}
                    </p>
                </div>

                <!-- Informasi Peminjaman -->
                <div class="bg-[#EBF4F6] p-6 rounded-2xl border border-[#7AB2B2]/40 space-y-3">

                    <h3 class="font-semibold text-[#09637E] text-lg">
                        Informasi Peminjaman
                    </h3>

                    <div class="grid grid-cols-2 gap-4 text-sm">

                        <div>
                            <p class="text-gray-500">Tanggal Pinjam</p>
                            <p class="font-semibold text-gray-700">
                                {{ \Carbon\Carbon::parse($peminjaman->tanggal_pinjam)->format('d M Y') }}
                            </p>
                        </div>

                        <div>
                            <p class="text-gray-500">Jatuh Tempo</p>
                            <p class="font-semibold text-gray-700">
                                {{ \Carbon\Carbon::parse($peminjaman->tanggal_jatuh_tempo)->format('d M Y') }}
                            </p>
                        </div>

                        <div>
                            <p class="text-gray-500">Tanggal Kembali</p>
                            <p class="font-semibold text-gray-700">
                                {{ \Carbon\Carbon::parse($peminjaman->tanggal_kembali)->format('d M Y') }}
                            </p>
                        </div>

                        <div>
                            <p class="text-gray-500">Status</p>

                            @if($peminjaman->status === 'dikembalikan')
                            <span
                                class="inline-block bg-[#7AB2B2]/30 text-[#09637E] px-4 py-1 rounded-full text-xs font-semibold">
                                Dikembalikan
                            </span>
                            @elseif($peminjaman->status === 'terlambat')
                            <span
                                class="inline-block bg-red-100 text-red-600 px-4 py-1 rounded-full text-xs font-semibold">
                                Terlambat
                            </span>
                            @elseif($peminjaman->status === 'dipinjam')
                            <span
                                class="inline-block bg-yellow-100 text-yellow-600 px-4 py-1 rounded-full text-xs font-semibold">
                                Dipinjam
                            </span>
                            @elseif($peminjaman->status === 'menunggu_validasi')
                            <span
                                class="inline-block bg-yellow-100 text-yellow-600 px-4 py-1 rounded-full text-xs font-semibold">
                                Menunggu Validasi
                            </span>
                            @else
                            <span
                                class="inline-block bg-red-100 text-red-600 px-4 py-1 rounded-full text-xs font-semibold">
                                Ditolak
                            </span>
                            @endif
                        </div>

                    </div>
                </div>

                <!-- ULASAN -->
                @if($peminjaman->tanggal_kembali)

                <div class="bg-white p-6 rounded-2xl border border-[#7AB2B2]/30 shadow-sm">

                    <h3 class="font-semibold text-[#09637E] mb-4">
                        Ulasan Anda
                    </h3>

                    @if(!$ulasan)

                    <button onclick="openModal()"
                        class="bg-[#088395] text-white px-6 py-2 rounded-xl hover:bg-[#09637E] transition shadow-md">
                        Beri Ulasan
                    </button>

                    @else

                    <div class="flex items-center mb-3">
                        @for($i = 1; $i <= 5; $i++) @if($i <=$ulasan->rating)
                            <span class="text-yellow-400 text-xl">★</span>
                            @else
                            <span class="text-gray-300 text-xl">★</span>
                            @endif
                            @endfor
                    </div>

                    <p class="text-gray-600 leading-relaxed">
                        {{ $ulasan->isi_ulasan }}
                    </p>

                    @endif

                </div>

                <!-- HAPUS -->
                {{--  <div>
                    <form action="{{ route('peminjam.riwayat-peminjaman.destroy', $peminjaman->id) }}" method="POST"
                onsubmit="return confirm('Yakin ingin menghapus riwayat ini?')">
                @csrf
                @method('DELETE')

                <button class="bg-red-500 text-white px-6 py-2 rounded-xl hover:bg-red-600 transition shadow-md">
                    Hapus Riwayat
                </button>
                </form>
            </div> --}}

            @endif

        </div>
    </div>
    </div>

    <!-- MODAL -->
    <div id="reviewModal" class="fixed inset-0 bg-black/40 hidden items-center justify-center backdrop-blur-sm">

        <div class="bg-white rounded-3xl p-8 w-full max-w-md shadow-2xl border border-[#7AB2B2]/40">

            <h2 class="text-xl font-bold text-[#09637E] mb-6">
                Beri Ulasan
            </h2>

            <form action="{{ route('peminjam.ulasan.store') }}" method="POST">
                @csrf
                <input type="hidden" name="buku_id" value="{{ $peminjaman->buku_id }}">

                <div class="mb-5">
                    <label class="block mb-2 font-semibold text-[#088395]">
                        Rating
                    </label>

                    <div class="flex space-x-2 text-3xl" id="starRating">
                        @for($i = 1; $i <= 5; $i++) <span data-value="{{ $i }}"
                            class="star cursor-pointer text-gray-300 transition">
                            ★
                            </span>
                            @endfor
                    </div>

                    <input type="hidden" name="rating" id="ratingValue" required>
                </div>

                <div class="mb-6">
                    <textarea name="isi_ulasan"
                        class="w-full border border-[#7AB2B2]/40 rounded-xl p-3 focus:outline-none focus:ring-2 focus:ring-[#7AB2B2]"
                        placeholder="Tulis ulasan Anda..." required></textarea>
                </div>

                <div class="flex justify-end gap-3">
                    <button type="button" onclick="closeModal()"
                        class="px-4 py-2 bg-gray-200 rounded-xl hover:bg-gray-300 transition">
                        Batal
                    </button>

                    <button type="submit"
                        class="px-4 py-2 bg-[#088395] text-white rounded-xl hover:bg-[#09637E] transition shadow-md">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>


    <script>
        function openModal() {
            document.getElementById('reviewModal').classList.remove('hidden');
            document.getElementById('reviewModal').classList.add('flex');
        }

        function closeModal() {
            document.getElementById('reviewModal').classList.add('hidden');
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
