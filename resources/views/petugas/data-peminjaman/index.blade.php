<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-[#3D3D3B] leading-tight">
            Data Peminjaman
        </h2>
    </x-slot>

    <div class="min-h-screen bg-[#F4F4F2] py-8">
        <div class="max-w-7xl mx-auto px-6">

            {{-- Success Alert --}}
            @if(session('success'))
            <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-5 py-4 rounded-2xl shadow-sm">
                {{ session('success') }}
            </div>
            @endif

            {{-- Error Alert --}}
            @if(session('error'))
            <div class="mb-6 bg-red-50 border border-red-200 text-red-600 px-5 py-4 rounded-2xl shadow-sm">
                {{ session('error') }}
            </div>
            @endif

            {{-- Statistik --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-6">

                {{-- Sedang Dipinjam --}}
                <div class="bg-[#E8E8E8] rounded-2xl border border-[#BBBFCA] p-6 shadow-sm
                            border-t-4 border-t-[#3D3D3B]">

                    <p class="text-sm text-[#3D3D3B]/60 font-medium">
                        Sedang Dipinjam
                    </p>

                    <h3 class="text-3xl font-bold text-[#3D3D3B] mt-2">
                        {{ $totalDipinjam }}
                    </h3>
                </div>

                {{-- Terlambat --}}
                <div class="bg-[#E8E8E8] rounded-2xl border border-[#BBBFCA] p-6 shadow-sm
                            border-t-4 border-t-red-500">

                    <p class="text-sm text-[#3D3D3B]/60 font-medium">
                        Terlambat
                    </p>

                    <h3 class="text-3xl font-bold text-red-500 mt-2">
                        {{ $totalTerlambat }}
                    </h3>
                </div>

            </div>

            {{-- Main Card --}}
            <div class="bg-[#E8E8E8] border border-[#BBBFCA] rounded-3xl shadow-sm overflow-hidden">

                {{-- Header --}}
                <div class="px-6 py-5 border-b border-[#BBBFCA] bg-[#F4F4F2]">
                    <h3 class="font-bold text-[#3D3D3B] text-lg">
                        Daftar Peminjaman Aktif
                    </h3>
                    <p class="text-sm text-[#3D3D3B]/60 mt-1">
                        Kelola dan pantau semua data peminjaman aktif.
                    </p>
                </div>

                <div class="p-6">

                    {{-- Filter Section --}}
                    <form method="GET" class="flex flex-col md:flex-row gap-3 mb-6">

                        {{-- Search --}}
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Cari judul buku / nama peminjam..." class="flex-1 rounded-2xl border border-[#BBBFCA] bg-white px-4 py-3
                                   focus:ring-2 focus:ring-[#3D3D3B] focus:border-[#3D3D3B]">

                        {{-- Filter Status --}}
                        <select name="status" class="rounded-2xl border border-[#BBBFCA] bg-white px-4 py-3
                                   focus:ring-2 focus:ring-[#3D3D3B]">

                            <option value="">
                                Semua Status
                            </option>

                            <option value="dipinjam" {{ request('status') == 'dipinjam' ? 'selected' : '' }}>
                                Dipinjam
                            </option>

                            <option value="terlambat" {{ request('status') == 'terlambat' ? 'selected' : '' }}>
                                Terlambat
                            </option>

                        </select>

                        {{-- Button --}}
                        <button class="px-6 py-3 rounded-2xl bg-[#3D3D3B] text-white
                                   hover:opacity-90 transition">
                            Filter
                        </button>

                    </form>

                    {{-- Table --}}
                    <div class="overflow-x-auto rounded-2xl border border-[#BBBFCA]">

                        <table class="w-full text-sm text-left">

                            <thead class="bg-[#3D3D3B] text-white">
                                <tr>
                                    <th class="px-4 py-4">No</th>
                                    <th class="px-4 py-4">Judul Buku</th>
                                    <th class="px-4 py-4">Peminjam</th>
                                    <th class="px-4 py-4 text-center">Tanggal Pinjam</th>
                                    <th class="px-4 py-4 text-center">Jatuh Tempo</th>
                                    <th class="px-4 py-4 text-center">Status</th>
                                    <th class="px-4 py-4 text-center">Aksi</th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-[#BBBFCA] bg-white">

                                @forelse($peminjaman as $index => $item)

                                @php
                                $jatuhTempo = \Carbon\Carbon::parse($item->tanggal_jatuh_tempo);
                                @endphp

                                <tr class="hover:bg-[#F4F4F2] transition">

                                    {{-- No --}}
                                    <td class="px-4 py-4">
                                        {{ $peminjaman->firstItem() + $index }}
                                    </td>

                                    {{-- Buku --}}
                                    <td class="px-4 py-4 font-medium text-[#3D3D3B]">
                                        {{ $item->buku->judul_buku }}
                                    </td>

                                    {{-- Peminjam --}}
                                    <td class="px-4 py-4">
                                        {{ $item->peminjam->nama ?? $item->peminjam->username }}
                                    </td>

                                    {{-- Tanggal Pinjam --}}
                                    <td class="px-4 py-4 text-center">
                                        {{ \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d M Y') }}
                                    </td>

                                    {{-- Jatuh Tempo --}}
                                    <td class="px-4 py-4 text-center">
                                        {{ $jatuhTempo->format('d M Y') }}
                                    </td>

                                    {{-- Status --}}
                                    <td class="px-4 py-4 text-center">

                                        @if($item->status === 'terlambat')
                                        <span class="px-3 py-1 rounded-full text-xs font-semibold
                                                    bg-red-100 text-red-600">
                                            Terlambat
                                        </span>
                                        @else
                                        <span class="px-3 py-1 rounded-full text-xs font-semibold
                                                    bg-green-100 text-green-600">
                                            Dipinjam
                                        </span>
                                        @endif

                                    </td>

                                    {{-- Aksi --}}
                                    <td class="px-4 py-4 text-center">

                                        <div class="flex items-center justify-center gap-2 flex-wrap">

                                            {{-- Sanksi --}}
                                            @if($item->status === 'terlambat')

                                            @if($item->denda)
                                            <div class="px-3 py-2 text-xs font-semibold rounded-xl
                                                            bg-red-50 text-red-600 border border-red-200">
                                                ✓ Sanksi Diberikan
                                            </div>
                                            @else
                                            <button onclick="openModal(
                                                                '{{ $item->id }}',
                                                                '{{ $item->buku->judul_buku }}',
                                                                '{{ $item->peminjam->nama ?? $item->peminjam->username }}',
                                                                '{{ $jatuhTempo->format('d M Y') }}'
                                                            )" class="px-4 py-2 rounded-xl text-xs font-semibold
                                                                   bg-red-500 text-white hover:bg-red-600 transition">
                                                Beri Sanksi
                                            </button>
                                            @endif

                                            @endif

                                            {{-- Konfirmasi --}}
                                            @if($item->status === 'terlambat' && $item->status_pembayaran !==
                                            'sudah_bayar')

                                            <div class="px-4 py-2 rounded-xl text-xs font-semibold
        bg-yellow-50 text-yellow-700 border border-yellow-200">
                                                Menunggu Pembayaran
                                            </div>

                                            @else

                                            <form action="{{ route('petugas.data-peminjaman.konfirmasi', $item->id) }}"
                                                method="POST"
                                                onsubmit="return confirm('Yakin konfirmasi pengembalian buku ini?')">

                                                @csrf
                                                @method('PUT')

                                                <button class="px-4 py-2 rounded-xl text-xs font-semibold
            bg-[#3D3D3B] text-white hover:opacity-90 transition">
                                                    Konfirmasi
                                                </button>
                                            </form>

                                            @endif

                                        </div>

                                    </td>

                                </tr>

                                @empty

                                <tr>
                                    <td colspan="7" class="text-center py-8 text-[#3D3D3B]/50">
                                        Tidak ada data peminjaman aktif.
                                    </td>
                                </tr>

                                @endforelse

                            </tbody>

                        </table>

                    </div>

                    {{-- Pagination --}}
                    <div class="mt-6">
                        {{ $peminjaman->links() }}
                    </div>

                    {{-- Notes --}}
                    <div class="mt-5 text-sm text-[#3D3D3B]/60">
                        <p>
                            * Halaman ini hanya menampilkan peminjaman aktif.
                            Data yang sudah dikembalikan tidak ditampilkan.
                        </p>
                    </div>

                </div>

            </div>

        </div>
    </div>

    {{-- Modal Sanksi --}}
    <div id="sanksiModal" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50 px-4">

        <div class="bg-[#F4F4F2] w-full max-w-md rounded-3xl shadow-xl overflow-hidden">

            {{-- Header --}}
            <div class="px-6 py-5 bg-[#3D3D3B]">
                <h2 class="text-white font-bold text-lg">
                    Berikan Sanksi
                </h2>
            </div>

            {{-- Content --}}
            <div class="p-6">

                <div class="space-y-3 text-sm mb-5">
                    <p>
                        <strong>Buku:</strong>
                        <span id="modalJudul"></span>
                    </p>

                    <p>
                        <strong>Peminjam:</strong>
                        <span id="modalPeminjam"></span>
                    </p>

                    <p>
                        <strong>Jatuh Tempo:</strong>
                        <span id="modalJatuhTempo"></span>
                    </p>
                </div>

                <form id="formSanksi" method="POST">
                    @csrf

                    <div class="mb-5">
                        <label class="block text-sm font-medium text-[#3D3D3B] mb-2">
                            Nominal Denda (Rp)
                        </label>

                        <input type="number" name="denda" min="1000" required class="w-full rounded-2xl border border-[#BBBFCA] bg-white px-4 py-3
                                   focus:ring-2 focus:ring-red-400">
                    </div>

                    <div class="flex justify-end gap-3">

                        <button type="button" onclick="closeModal()" class="px-4 py-2 rounded-2xl border border-[#BBBFCA]
                                   text-[#3D3D3B] hover:bg-[#E8E8E8] transition">
                            Batal
                        </button>

                        <button type="submit"
                            class="px-4 py-2 rounded-2xl bg-red-500 text-white hover:bg-red-600 transition">
                            Simpan
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

    <script>
        function openModal(id, judul, peminjam, jatuhTempo) {
            document.getElementById('modalJudul').innerText = judul;
            document.getElementById('modalPeminjam').innerText = peminjam;
            document.getElementById('modalJatuhTempo').innerText = jatuhTempo;

            let urlTemplate = "{{ route('petugas.peminjaman.berikan-sanksi', ':id') }}";
            let actionUrl = urlTemplate.replace(':id', id);

            document.getElementById('formSanksi').action = actionUrl;

            document.getElementById('sanksiModal').classList.remove('hidden');
            document.getElementById('sanksiModal').classList.add('flex');
        }

        function closeModal() {
            document.getElementById('sanksiModal').classList.add('hidden');
            document.getElementById('sanksiModal').classList.remove('flex');
        }

    </script>

</x-app-layout>
