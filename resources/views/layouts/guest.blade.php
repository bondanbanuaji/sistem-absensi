<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'AbsensiKu') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-gradient-to-br from-indigo-900 via-purple-800 to-indigo-950 flex items-center justify-center font-sans">
    <div class="w-full max-w-md p-8 bg-white/10 backdrop-blur-xl border border-white/20 rounded-2xl shadow-2xl text-white">
        <div class="flex flex-col items-center mb-6">
            {{-- <img src="{{ asset('images/zero.jpg') }}" alt="Logo" class="w-20 h-20 mb-3 drop-shadow-lg"> --}}
            <h1 class="text-2xl font-bold tracking-wide">Sistem Absensi</h1>
            <p class="text-sm opacity-70">Login untuk melanjutkan</p>
        </div>
        
        <div class="mt-4">
            {{ $slot }}
        </div>
    </div>
</body>
</html>