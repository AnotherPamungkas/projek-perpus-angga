@php
$role = auth()->user()->role ?? null;
@endphp


<nav class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
@if ($role === 'admin')
@include('layouts.navbar.admin')
@elseif ($role === 'petugas')
@include('layouts.navbar.petugas')
@elseif ($role === 'siswa')
@include('layouts.navbar.siswa')
@endif
</div>
</nav>