<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-100">Detail Siswa</h2>
    </x-slot>

    <div class="max-w-2xl mx-auto mt-6 bg-gray-800 rounded-2xl p-6 shadow-lg text-gray-200">
        <div class="flex items-center space-x-6">
            <img src="{{ $student->photo ? asset('storage/'.$student->photo) : 'https://ui-avatars.com/api/?name='.$student->name }}"
                alt="{{ $student->name }}" class="h-24 w-24 rounded-full border border-gray-600">
            <div>
                <h3 class="text-2xl font-bold">{{ $student->name }}</h3>
                <p class="text-gray-400">NIS: {{ $student->nis }}</p>
                <p class="text-gray-400">Kelas: {{ $student->kelas ?? '-' }}</p>
                <p class="text-gray-400">Telepon: {{ $student->phone ?? '-' }}</p>
            </div>
        </div>

        <div class="mt-6 flex justify-end">
            <a href="{{ route('students.index') }}"
               class="px-4 py-2 bg-indigo-600 hover:bg-indigo-500 text-white rounded-lg">Kembali</a>
        </div>
    </div>
</x-app-layout>
