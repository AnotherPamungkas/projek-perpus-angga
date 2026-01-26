<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200">
            Dashboard Admin
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
                    <h3 class="text-sm text-gray-500">Total Buku</h3>
                    <p class="text-3xl font-bold text-gray-800 dark:text-white">
                        125
                    </p>
                </div>

                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
                    <h3 class="text-sm text-gray-500">Total Pengguna</h3>
                    <p class="text-3xl font-bold text-gray-800 dark:text-white">
                        42
                    </p>
                </div>

                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
                    <h3 class="text-sm text-gray-500">Total Peminjaman</h3>
                    <p class="text-3xl font-bold text-gray-800 dark:text-white">
                        310
                    </p>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
