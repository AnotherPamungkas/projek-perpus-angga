<x-app-layout>
    <x-slot name="header">
        Data Peminjaman
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
            <div class="mb-4 bg-[#7AB2B2] text-white px-4 py-3 rounded-xl shadow">
                {{ session('success') }}
            </div>
            @endif

            @if(session('error'))
            <div class="mb-4 bg-red-100 text-red-600 px-4 py-3 rounded-xl shadow">
                {{ session('error') }}
            </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                <div class="bg-white shadow-xl rounded-2xl p-5 border-l-4 border-[#09637E]">
                    <p class="text-sm text-gray-500">Sedang Dipinjam</p>
                    <h3 class="text-2xl font-bold text-[#09637E]">
                        {{ $totalDipinjam }}
                    </h3>
                </div>

                <div class="bg-white shadow-xl rounded-2xl p-5 border-l-4 border-red-500">
                    <p class="text-sm text-gray-500">Terlambat</p>
                    <h3 class="text-2xl font-bold text-red-600">
                        {{ $totalTerlambat }}
                    </h3>
                </div>
            </div>

            <div class="bg-white shadow-xl rounded-2xl p-6 mb-6">

                <div class="flex flex-col md:flex-row justify-between gap-4">

                    <form method="GET" class="flex gap-2">
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Cari judul / nama peminjam..."
                            class="border border-[#7AB2B2] rounded-lg px-4 py-2 focus:ring-2 focus:ring-[#088395] focus:outline-none">

                        <select name="status"
                            class="border border-[#7AB2B2] rounded-lg px-3 py-2 focus:ring-2 focus:ring-[#088395] focus:outline-none">
                            <option value="">Semua Status</option>
                            <option value="dipinjam" {{ request('status')=='dipinjam'?'selected':'' }}>
                                Dipinjam
                            </option>
                            <option value="terlambat" {{ request('status')=='terlambat'?'selected':'' }}>
                                Terlambat
                            </option>
                        </select>

                        <button class="bg-[#09637E] text-white px-4 py-2 rounded-lg hover:bg-[#088395] transition">
                            Filter
                        </button>
                    </form>

                </div>

                <div class="overflow-x-auto mt-6">
                    <table class="w-full table-fixed text-sm text-left">
                        <thead class="bg-[#09637E] text-white">
                            <tr>
                                <th class="px-4 py-3 w-12">No</th>
                                <th class="px-4 py-3">Judul Buku</th>
                                <th class="px-4 py-3">Peminjam</th>
                                <th class="px-4 py-3 text-center">Tanggal Pinjam</th>
                                <th class="px-4 py-3 text-center">Jatuh Tempo</th>
                                <th class="px-4 py-3 text-center">Status</th>
                                <th class="px-4 py-3 text-center">Aksi</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-200">
                            @forelse($peminjaman as $index => $item)

                            @php
                            $today = \Carbon\Carbon::now();
                            $jatuhTempo = \Carbon\Carbon::parse($item->tanggal_jatuh_tempo);
                            @endphp

                            <tr class="hover:bg-[#EBF4F6] transition">

                                <td class="px-4 py-3">
                                    {{ $peminjaman->firstItem() + $index }}
                                </td>

                                <td class="px-4 py-3 font-medium">
                                    {{ $item->buku->judul_buku }}
                                </td>

                                <td class="px-4 py-3">
                                    {{ $item->peminjam->nama ?? $item->peminjam->username }}
                                </td>

                                <td class="px-4 py-3 text-center">
                                    {{ \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d M Y') }}
                                </td>

                                <td class="px-4 py-3 text-center">
                                    {{ $jatuhTempo->format('d M Y') }}
                                </td>

                                <td class="px-4 py-3 text-center">
                                    @if($item->status === 'terlambat')
                                    <span class="px-3 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-600">
                                        Terlambat
                                    </span>
                                    @elseif($item->status === 'dipinjam')
                                    <span
                                        class="px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-600">
                                        Dipinjam
                                    </span>
                                    @endif
                                </td>

                                <td class="px-4 py-3 text-center">
                                    <div class="flex items-center justify-center gap-2">

                                        @if($item->status === 'terlambat')

                                        @if($item->denda)
                                        <div class="px-3 py-1.5 text-xs font-semibold rounded-full
                        bg-red-50 text-red-600 border border-red-200">
                                            ✓ Sanksi Diberikan
                                        </div>
                                        @else
                                        <button onclick="openModal(
                    '{{ $item->id }}',
                    '{{ $item->buku->judul_buku }}',
                    '{{ $item->peminjam->nama ?? $item->peminjam->username }}',
                    '{{ $jatuhTempo->format('d M Y') }}'
                )" class="px-4 py-1.5 text-xs font-semibold rounded-lg
                       bg-red-500 text-white
                       hover:bg-red-600 active:scale-95
                       shadow-sm transition-all duration-150">
                                            Beri Sanksi
                                        </button>
                                        @endif

                                        @endif

                                        <form action="{{ route('petugas.data-peminjaman.konfirmasi', $item->id) }}"
                                            method="POST"
                                            onsubmit="return confirmKonfirmasi('{{ $item->status }}', '{{ $item->denda ? 1 : 0 }}')">
                                            @csrf
                                            @method('PUT')

                                            <button class="px-4 py-1.5 text-xs font-semibold rounded-lg
                   bg-[#09637E] text-white
                   hover:bg-[#075468]
                   active:scale-95
                   shadow-sm transition-all duration-150">
                                                Konfirmasi
                                            </button>
                                        </form>

                                    </div>
                                </td>
                            </tr>

                            @empty
                            <tr>
                                <td colspan="7" class="text-center py-6 text-gray-500">
                                    Tidak ada data peminjaman aktif.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <!-- Modal -->
                    <div id="sanksiModal"
                        class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">

                        <div class="bg-white w-full max-w-md rounded-2xl shadow-xl p-6">

                            <h2 class="text-lg font-bold mb-4 text-[#09637E]">
                                Berikan Sanksi
                            </h2>

                            <div class="mb-4 text-sm space-y-1">
                                <p><strong>Buku:</strong> <span id="modalJudul"></span></p>
                                <p><strong>Peminjam:</strong> <span id="modalPeminjam"></span></p>
                                <p><strong>Jatuh Tempo:</strong> <span id="modalJatuhTempo"></span></p>
                            </div>

                            <form id="formSanksi" method="POST">
                                @csrf

                                <div class="mb-4">
                                    <label class="block text-sm font-medium mb-1">
                                        Nominal Denda (Rp)
                                    </label>
                                    <input type="number" name="denda" required min="1000"
                                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-red-400 focus:outline-none">
                                </div>

                                <div class="flex justify-end gap-2">
                                    <button type="button" onclick="closeModal()"
                                        class="px-4 py-2 bg-gray-300 rounded-lg">
                                        Batal
                                    </button>

                                    <button type="submit"
                                        class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600">
                                        Simpan
                                    </button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>

                <div class="mt-6">
                    {{ $peminjaman->links() }}
                </div>

                <div class="mt-4 text-sm text-gray-500">
                    <p>
                        * Halaman ini hanya menampilkan peminjaman aktif.
                        Data yang sudah dikembalikan tidak ditampilkan.
                    </p>
                </div>

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

    <script>
        function confirmKonfirmasi(status, sudahAdaDenda) {

            if (status === 'terlambat') {

                if (!sudahAdaDenda) {
                    alert('Buku terlambat. Harap berikan sanksi terlebih dahulu.');
                    return false;
                }

                return confirm('Apakah denda sudah dibayar oleh peminjam?');

            } else {
                return confirm('Yakin ingin konfirmasi pengembalian buku ini?');
            }
        }

    </script>
</x-app-layout>
