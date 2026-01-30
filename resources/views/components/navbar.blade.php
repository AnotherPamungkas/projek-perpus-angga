<nav class="bg-white dark:bg-gray-800 shadow">
    <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">

        <div class="text-lg font-bold text-gray-800 dark:text-gray-200">
            Perpustakaan Digital
        </div>

        <div class="flex gap-4">
            @auth
                <span class="text-sm text-gray-600 dark:text-gray-300">
                    {{ auth()->user()->name }}
                </span>
            @endauth
        </div>

    </div>
</nav>
