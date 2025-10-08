<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold text-gray-800 dark:text-gray-100">
            {{ __('Attendance List') }}
        </h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto">
        <x-alert />

        <x-card>
            <div class="flex justify-between mb-4">
                <a href="{{ route('attendances.create') }}"
                   class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition">
                    + Add Attendance
                </a>
            </div>

            <table class="w-full border-collapse border border-gray-300">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="p-3 border text-left">#</th>
                        <th class="p-3 border text-left">Student</th>
                        <th class="p-3 border text-left">Date</th>
                        <th class="p-3 border text-left">Status</th>
                        <th class="p-3 border text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($attendances as $attendance)
                        <tr class="hover:bg-gray-50">
                            <td class="p-3 border">{{ $loop->iteration }}</td>
                            <td class="p-3 border">{{ $attendance->student->name }}</td>
                            <td class="p-3 border">{{ $attendance->date }}</td>
                            <td class="p-3 border">
                                <span class="px-2 py-1 rounded text-white 
                                    {{ $attendance->status === 'Present' ? 'bg-green-500' : 'bg-red-500' }}">
                                    {{ $attendance->status }}
                                </span>
                            </td>
                            <td class="p-3 border text-center">
                                <a href="{{ route('attendances.edit', $attendance->id) }}"
                                   class="text-indigo-600 hover:text-indigo-800 mr-2">Edit</a>
                                <form action="{{ route('attendances.destroy', $attendance->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        onclick="return confirm('Are you sure?')"
                                        class="text-red-600 hover:text-red-800">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="p-3 text-center text-gray-500">No attendance data found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </x-card>
    </div>
</x-app-layout>
