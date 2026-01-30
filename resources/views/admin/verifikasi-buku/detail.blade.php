<x-app-layout>
    <div class="p-6 max-w-3xl">
        <h1 class="text-2xl font-bold mb-4">Detail Buku</h1>

        <div class="mb-4">
            @if($buku->cover)
                <img src="{{ asset('storage/cover-buku/'.$buku->cover) }}"
                     class="w-40 rounded mb-3">
            @endif
        </div>

        <div class="space-y-2">
            <p><strong>Judul:</strong> {{ $buku->judul_buku }}</p>
            <p><strong>Pengarang:</strong> {{ $buku->pengarang }}</p>
            <p><strong>Penerbit:</strong> {{ $buku->penerbit }}</p>
            <p><strong>Tahun Terbit:</strong> {{ $buku->tahun_terbit }}</p>
            <p><strong>Jumlah:</strong> {{ $buku->jumlah_buku }}</p>
            <p><strong>Deskripsi:</strong> {{ $buku->deskripsi }}</p>
            <p>
                <strong>Status:</strong>
                <span class="text-yellow-600 font-semibold">
                    {{ $buku->status }}
                </span>
            </p>
        </div>

        <div class="mt-6 flex gap-3">
            <form action="{{ route('admin.verifikasi-buku.verify', $buku->id) }}" method="POST">
                @csrf
                <button class="bg-green-600 text-white px-4 py-2 rounded">
                    Setujui
                </button>
            </form>

            <form action="{{ route('admin.verifikasi-buku.reject', $buku->id) }}" method="POST">
                @csrf
                <button class="bg-red-600 text-white px-4 py-2 rounded">
                    Tolak
                </button>
            </form>

            <a href="{{ route('admin.verifikasi-buku.index') }}"
               class="px-4 py-2 border rounded">
                Kembali
            </a>
        </div>
    </div>
</x-app-layout>
