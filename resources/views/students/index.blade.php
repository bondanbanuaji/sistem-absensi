<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-100">
            Data Siswa
        </h2>
    </x-slot>

    <div class="mt-6 bg-gray-800 shadow-lg rounded-2xl p-6">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-lg font-semibold text-gray-100">Daftar Siswa</h3>
            <a href="{{ route('students.create') }}"
               class="px-4 py-2 bg-indigo-600 hover:bg-indigo-500 text-white rounded-lg shadow transition">
               + Tambah Siswa
            </a>
        </div>

        {{-- Table --}}
        <div class="overflow-x-auto rounded-lg border border-gray-700">
            <table class="min-w-full text-sm text-gray-300">
                <thead class="bg-gray-700 text-gray-100 uppercase text-xs">
                    <tr>
                        <th class="py-3 px-4 text-left">NIS</th>
                        <th class="py-3 px-4 text-left">Nama</th>
                        <th class="py-3 px-4 text-left">Kelas</th>
                        <th class="py-3 px-4 text-left">Telepon</th>
                        <th class="py-3 px-4 text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-700">
                    @forelse ($students as $student)
                        <tr class="hover:bg-gray-700 transition">
                            <td class="py-3 px-4">{{ $student->nis }}</td>
                            <td class="py-3 px-4">{{ $student->name }}</td>
                            <td class="py-3 px-4">{{ $student->kelas ?? '-' }}</td>
                            <td class="py-3 px-4">{{ $student->phone ?? '-' }}</td>
                            <td class="py-3 px-4 space-x-2">
                                <a href="{{ route('students.show', $student->id) }}"
                                   class="text-blue-400 hover:text-blue-300">Detail</a>
                                <a href="{{ route('students.edit', $student->id) }}"
                                   class="text-yellow-400 hover:text-yellow-300">Edit</a>
                                <form action="{{ route('students.destroy', $student->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button onclick="return confirm('Hapus siswa ini?')"
                                            class="text-red-500 hover:text-red-400">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-4 text-center text-gray-400">Belum ada data siswa.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="mt-6">{{ $students->links() }}</div>
    </div>
</x-app-layout>