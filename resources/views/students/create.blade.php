<x-app-layout title="Tambah Siswa">
    <div class="bg-gray-800 p-6 rounded-2xl shadow-lg max-w-2xl mx-auto">
        <h2 class="text-2xl font-semibold mb-6 text-indigo-400">Tambah Data Siswa</h2>

        <form action="{{ route('students.store') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="block mb-2">Nama</label>
                <input type="text" name="name" value="{{ old('name') }}" class="w-full bg-gray-700 border border-gray-600 rounded p-2" required>
            </div>

            <div>
                <label class="block mb-2">NIS</label>
                <input type="text" name="nis" value="{{ old('nis') }}" class="w-full bg-gray-700 border border-gray-600 rounded p-2" required>
            </div>

            <div>
                <label class="block mb-2">Kelas</label>
                <input type="text" name="class" value="{{ old('class') }}" class="w-full bg-gray-700 border border-gray-600 rounded p-2" required>
            </div>

            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 px-4 py-2 rounded text-white transition">
                Simpan
            </button>
        </form>
    </div>
</x-app-layout>
