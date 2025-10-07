<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Sistem Absensi' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-900 text-gray-100 min-h-screen flex flex-col">

    {{-- Navbar --}}
    <nav class="bg-gray-800 shadow-lg">
        <div class="max-w-7xl mx-auto px-4 py-3 flex justify-between items-center">
            <h1 class="text-xl font-bold text-indigo-400">📋 Sistem Absensi</h1>
            <div class="space-x-4">
                <a href="{{ route('dashboard') }}" class="hover:text-indigo-400">Dashboard</a>

                @if(Auth::user()->role === 'admin')
                    <a href="{{ route('students.index') }}" class="hover:text-indigo-400">Siswa</a>
                    <a href="{{ route('attendances.index') }}" class="hover:text-indigo-400">Absensi</a>
                @elseif(Auth::user()->role === 'teacher')
                    <a href="{{ route('teacher.attendance.index') }}" class="hover:text-indigo-400">Absensi</a>
                @endif

                @auth
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="hover:text-red-400">Logout</button>
                    </form>
                @endauth
            </div>
        </div>
    </nav>

    {{-- Main content --}}
    <main class="flex-1 p-6 max-w-7xl mx-auto w-full">
        @if (session('success'))
            <div class="bg-green-600 text-white px-4 py-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        {{ $slot }}
    </main>

    {{-- Footer --}}
    <footer class="bg-gray-800 text-center py-3 text-sm text-gray-400">
        &copy; {{ date('Y') }} Sistem Absensi | Dibuat oleh Banu 🚀
    </footer>

</body>

</html>