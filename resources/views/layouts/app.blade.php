<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'PerpusDig') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-[#EBF4F6] text-gray-800">

<div class="min-h-screen">

    @auth
        @if (Auth::user()->role === 'admin')
            @include('layouts.navbar.nav-admin')
        @elseif (Auth::user()->role === 'petugas')
            @include('layouts.navbar.nav-petugas')
        @elseif (Auth::user()->role === 'peminjam')
            @include('layouts.navbar.nav-peminjam')
        @endif
    @endauth

    <!--  #09637E -->

    @isset($header)
        <header class="bg-white shadow-md">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <h2 class="font-semibold text-xl text-white">
                    {{ $header }}
                </h2>
            </div>
        </header>
    @endisset

    <main class="py-8">
        {{ $slot }}
    </main>

</div>

</body>
</html>
