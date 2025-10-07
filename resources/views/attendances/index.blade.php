<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-100 leading-tight">
            Data Absensi
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6 text-gray-900 dark:text-gray-100">
                <form method="GET" action="{{ route('attendances.index') }}" class="flex gap-4 mb-4">
                    <input type="date" name="date" value="{{ request('date') }}"
                           class="rounded-lg border-gray-300 dark:bg-gray-700 dark:text-white">
                    <input type="text" name="name" value="{{ request('name') }}" placeholder="Cari nama siswa..."
                           class="rounded-lg border-gray-300 dark:bg-gray-700 dark:text-white">
                    <button class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg">Filter</button>
                </form>

                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase">Nama</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase">Tanggal</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                        @foreach ($attendances as $attendance)
                        <tr>
                            <td class="px-6 py-4">{{ $attendance->student->name }}</td>
                            <td class="px-6 py-4">{{ $attendance->date }}</td>
                            <td class="px-6 py-4 capitalize">{{ $attendance->status }}</td>
                            <td class="px-6 py-4">
                                <a href="{{ route('attendances.edit', $attendance) }}" class="text-yellow-500 hover:underline">Edit</a>
                                <form action="{{ route('attendances.destroy', $attendance) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-600 hover:underline" onclick="return confirm('Yakin hapus data ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="mt-4">{{ $attendances->links() }}</div>
            </div>
        </div>
    </div>
</x-app-layout>
