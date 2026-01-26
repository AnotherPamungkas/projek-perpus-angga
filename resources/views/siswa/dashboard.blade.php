<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200">
            Dashboard Siswa
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
                    <h3 class="text-sm text-gray-500">Buku Dipinjam</h3>
                    <p class="text-3xl font-bold text-gray-800 dark:text-white">
                        2
                    </p>
                </div>

                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
                    <h3 class="text-sm text-gray-500">Riwayat Peminjaman</h3>
                    <p class="text-3xl font-bold text-gray-800 dark:text-white">
                        12
                    </p>
                </div>

                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
                    <h3 class="text-sm text-gray-500">Status Akun</h3>
                    <p class="text-lg font-semibold text-green-600">
                        Aktif
                    </p>
                </div>
            </div>

            <div class="mt-8 bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
                <h3 class="font-semibold text-lg text-gray-800 dark:text-white mb-3">
                    Informasi
                </h3>

                <p class="text-gray-600 dark:text-gray-300">
                    Kamu masih bisa meminjam maksimal <b>3 buku</b>.
                    Jangan lupa cek tanggal pengembalian ya 📚
                </p>
            </div>

        </div>
    </div>
</x-app-layout>
