<x-app-layout>
    <div class="p-6 max-w-xl mx-auto">
        <h1 class="text-xl font-bold mb-4">Form Peminjaman Buku</h1>

        <form method="POST" action="{{ route('siswa.peminjaman.store') }}">
            @csrf

            <input type="hidden" name="buku_id" value="{{ $buku->id }}">

            <div class="mb-4">
                <label class="block">Judul Buku</label>
                <input type="text" class="w-full border rounded px-3 py-2"
                       value="{{ $buku->judul_buku }}" disabled>
            </div>

            <div class="mb-4">
                <label class="block">Tanggal Pinjam</label>
                <input type="date" name="tanggal_pinjam" class="w-full border rounded px-3 py-2" required>
            </div>

            <div class="mb-4">
                <label class="block">Tanggal Jatuh Tempo</label>
                <input type="date" name="tanggal_jatuh_tempo" class="w-full border rounded px-3 py-2" required>
            </div>

            <button class="bg-green-600 text-white px-4 py-2 rounded">
                Ajukan Peminjaman
            </button>
        </form>
    </div>
</x-app-layout>
