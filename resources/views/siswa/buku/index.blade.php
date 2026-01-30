<x-app-layout>
    <div class="p-6">
        <h1 class="text-2xl font-bold mb-4">Katalog Buku</h1>

        <div class="grid grid-cols-4 gap-4">
            @foreach ($dataBuku as $buku)
                <div class="border rounded p-4">
                    <img
                        src="{{ $buku->cover ? asset('storage/cover-buku/'.$buku->cover) : asset('images/default-book.png') }}"
                        class="h-48 w-full object-cover mb-2"
                    >

                    <h2 class="font-semibold">{{ $buku->judul_buku }}</h2>
                    <p class="text-sm text-gray-500">{{ $buku->pengarang }}</p>

                    <a href="{{ route('siswa.buku.detail', $buku->id) }}"
                       class="text-blue-600 text-sm mt-2 inline-block">
                        Lihat Detail
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
