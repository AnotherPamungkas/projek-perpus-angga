<div class="flex justify-between h-16 items-center">
<span class="font-semibold text-gray-700">Siswa</span>
<form method="POST" action="{{ route('logout') }}">@csrf
<button class="text-sm text-red-500">Logout</button>
</form>
</div>