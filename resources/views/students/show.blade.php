<x-app-layout title="Detail Siswa">
    <div class="bg-gray-800 p-6 rounded-2xl shadow-lg max-w-2xl mx-auto">
        <h2 class="text-2xl font-semibold mb-6 text-indigo-400">Detail Siswa</h2>

        <div class="space-y-3">
            <div><strong>Nama:</strong> {{ $student->name }}</div>
            <div><strong>NIS:</strong> {{ $student->nis }}</div>
            <div><strong>Kelas:</strong> {{ $student->class }}</div>
        </div>

        <div class="mt-6 flex justify-between">
            <a href="{{ route('students.index') }}" class="text-gray-300 hover:text-indigo-400">← Kembali</a>
            <a href="{{ route('students.edit', $student) }}" class="bg-yellow-600 hover:bg-yellow-700 px-4 py-2 rounded text-white transition">Edit</a>
        </div>
    </div>
</x-app-layout>
