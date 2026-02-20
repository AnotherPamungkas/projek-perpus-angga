<x-app-layout>
    <x-slot name="header">
        Validasi Peminjaman
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

          {{--  <div class="mb-6 bg-white shadow-xl rounded-2xl p-5 border-l-4 border-[#09637E]">
                <p class="text-sm text-gray-500">Menunggu Validasi</p>
                <h3 class="text-2xl font-bold text-[#09637E]">
                    {{ $totalMenunggu }}
                </h3>
            </div> --}}

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                @forelse($peminjaman as $item)

                <div class="bg-white shadow-xl rounded-2xl overflow-hidden hover:shadow-2xl transition">

                    <img src="{{ asset('storage/'.$item->buku->cover) }}" class="h-48 w-full object-cover">

                    <div class="p-5 space-y-2">

                        <h3 class="font-bold text-[#09637E] text-lg">
                            {{ $item->buku->judul_buku }}
                        </h3>

                        <p class="text-sm text-gray-500">
                            {{ $item->buku->kategori->nama_kategori }}
                        </p>

                        <div class="text-sm text-gray-600">
                            <p><strong>Peminjam:</strong> {{ $item->peminjam->nama }}</p>
                            <p><strong>Jumlah:</strong> {{ $item->jumlah_dipinjam }}</p>
                            <p><strong>Tgl Pinjam:</strong>
                                {{ \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d M Y') }}</p>
                            <p><strong>Jatuh Tempo:</strong>
                                {{ \Carbon\Carbon::parse($item->tanggal_jatuh_tempo)->format('d M Y') }}</p>
                            <p><strong>Stok Tersedia:</strong> {{ $item->buku->jumlah_buku }}</p>
                        </div>

                        @if($item->buku->jumlah_buku < $item->jumlah_dipinjam)
                            <div class="bg-red-100 text-red-600 text-xs px-3 py-2 rounded-lg">
                                Stok tidak mencukupi
                            </div>
                            @endif

                            <a href="{{ route('petugas.validasi-peminjaman.detail',$item->id) }}"
                                class="block text-center mt-3 bg-[#09637E] hover:bg-[#088395] text-white py-2 rounded-lg transition">
                                Detail
                            </a>

                    </div>
                </div>

                @empty
                <p class="text-gray-500">Tidak ada data menunggu validasi.</p>
                @endforelse

            </div>

            <div class="mt-6">
                {{ $peminjaman->links() }}
            </div>

        </div>
    </div>
</x-app-layout>
