<x-app-layout>
    <div class="p-6 max-w-4xl mx-auto">
        <div class="grid grid-cols-2 gap-6">
            <img
                src="{{ $buku->cover ? asset('storage/cover-buku/'.$buku->cover) : asset('images/default-book.png') }}"
                class="w-full h-80 object-cover rounded"
            >

            <div>
                <h1 class="text-2xl font-bold">{{ $buku->judul_buku }}</h1>
                <p>Pengarang: {{ $buku->pengarang }}</p>
                <p>Penerbit: {{ $buku->penerbit }}</p>
                <p>Tahun: {{ $buku->tahun_terbit }}</p>
                <p class="mt-2">{{ $buku->deskripsi }}</p>

                <a href="{{ route('siswa.peminjaman.create', $buku->id) }}"
                   class="mt-4 inline-block bg-blue-600 text-white px-4 py-2 rounded">
                    Ajukan Peminjaman
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
