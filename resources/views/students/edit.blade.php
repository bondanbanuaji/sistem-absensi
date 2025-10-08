<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-100">Edit Data Siswa</h2>
    </x-slot>

    <div class="max-w-3xl mx-auto mt-6 bg-gray-800 rounded-2xl p-6 shadow-lg">
        <form action="{{ route('students.update', $student->id) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-gray-300 mb-2">NIS</label>
                <input type="text" name="nis" value="{{ old('nis', $student->nis) }}"
                    class="w-full bg-gray-900 border border-gray-700 rounded-lg px-4 py-2 text-gray-200">
            </div>

            <div>
                <label class="block text-gray-300 mb-2">Nama Lengkap</label>
                <input type="text" name="name" value="{{ old('name', $student->name) }}"
                    class="w-full bg-gray-900 border border-gray-700 rounded-lg px-4 py-2 text-gray-200">
            </div>

            <div>
                <label class="block text-gray-300 mb-2">Kelas</label>
                <input type="text" name="kelas" value="{{ old('kelas', $student->kelas) }}"
                    class="w-full bg-gray-900 border border-gray-700 rounded-lg px-4 py-2 text-gray-200">
            </div>

            <div>
                <label class="block text-gray-300 mb-2">Nomor Telepon</label>
                <input type="text" name="phone" value="{{ old('phone', $student->phone) }}"
                    class="w-full bg-gray-900 border border-gray-700 rounded-lg px-4 py-2 text-gray-200">
            </div>

            <div>
                <label class="block text-gray-300 mb-2">Foto (ubah jika perlu)</label>
                @if($student->photo)
                    <img src="{{ asset('storage/'.$student->photo) }}" alt="Foto Siswa"
                        class="h-24 rounded-lg mb-3 border border-gray-700">
                @endif
                <input type="file" name="photo" class="text-gray-200">
            </div>

            <div class="flex justify-end space-x-4">
                <a href="{{ route('students.index') }}" class="px-4 py-2 bg-gray-600 hover:bg-gray-500 text-white rounded-lg">Batal</a>
                <button type="submit" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-500 text-white rounded-lg">Perbarui</button>
            </div>
        </form>
    </div>
</x-app-layout>
