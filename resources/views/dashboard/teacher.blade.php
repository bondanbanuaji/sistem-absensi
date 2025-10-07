<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            Dashboard Guru
        </h2>
    </x-slot>

    <div class="py-6 max-w-6xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg p-6">
            <h3 class="text-lg font-semibold mb-3">Selamat datang, {{ Auth::user()->name }}</h3>
            <p class="text-gray-600 dark:text-gray-300">Anda dapat mengelola absensi siswa di halaman ini.</p>
            <a href="{{ route('attendances.index') }}" 
               class="mt-4 inline-block px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
               Lihat Data Absensi
            </a>
        </div>
    </div>
</x-app-layout>
