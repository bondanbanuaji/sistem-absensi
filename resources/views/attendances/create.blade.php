<x-app-layout title="Tambah Absensi">
    <div class="bg-gray-800 p-6 rounded-2xl shadow-lg">
        <h2 class="text-2xl font-semibold mb-6 text-indigo-400">Tambah Absensi</h2>

        <form action="{{ route('attendances.store') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="block mb-2">Siswa</label>
                <select name="student_id" class="w-full bg-gray-700 border border-gray-600 rounded p-2">
                    @foreach($students as $student)
                        <option value="{{ $student->id }}">{{ $student->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block mb-2">Tanggal</label>
                <input type="date" name="date" class="w-full bg-gray-700 border border-gray-600 rounded p-2">
            </div>

            <div>
                <label class="block mb-2">Status</label>
                <select name="status" class="w-full bg-gray-700 border border-gray-600 rounded p-2">
                    <option value="present">Hadir</option>
                    <option value="absent">Alpa</option>
                    <option value="sick">Sakit</option>
                    <option value="permission">Izin</option>
                </select>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block mb-2">Waktu Masuk</label>
                    <input type="time" name="time_in" class="w-full bg-gray-700 border border-gray-600 rounded p-2">
                </div>
                <div>
                    <label class="block mb-2">Waktu Keluar</label>
                    <input type="time" name="time_out" class="w-full bg-gray-700 border border-gray-600 rounded p-2">
                </div>
            </div>

            <div>
                <label class="block mb-2">Catatan</label>
                <textarea name="note" class="w-full bg-gray-700 border border-gray-600 rounded p-2"></textarea>
            </div>

            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 px-4 py-2 rounded text-white transition">
                Simpan
            </button>
        </form>
    </div>
</x-app-layout>