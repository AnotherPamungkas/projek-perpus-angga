<div class="flex justify-between h-16">
<!-- Left -->
<div class="flex items-center gap-8">
<span class="text-lg font-bold text-gray-800 dark:text-gray-200">
Admin Dashboard
</span>


<div class="hidden sm:flex gap-6 text-sm font-medium">
<a href="#" class="text-gray-600 hover:text-indigo-600">Dashboard</a>
<a href="#" class="text-gray-600 hover:text-indigo-600">Buku</a>
<a href="#" class="text-gray-600 hover:text-indigo-600">Pengguna</a>
</div>
</div>


<!-- Right -->
<div class="flex items-center gap-4">
<span class="text-sm text-gray-600">{{ auth()->user()->name }}</span>


<form method="POST" action="{{ route('logout') }}">
@csrf
<button class="text-sm text-red-500 hover:text-red-600">
Logout
</button>
</form>
</div>
</div>