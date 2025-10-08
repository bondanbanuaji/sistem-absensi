<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold text-gray-800 dark:text-gray-100">
            {{ __('Student List') }}
        </h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto">
        <x-alert />

        <x-card>
            @if(auth()->user()->role === 'admin')
                <div class="flex justify-between mb-4">
                    <a href="{{ route('students.create') }}"
                       class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition">
                        + Add Student
                    </a>
                </div>
            @endif

            <table class="w-full border-collapse border border-gray-300">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="p-3 border text-left">#</th>
                        <th class="p-3 border text-left">Name</th>
                        <th class="p-3 border text-left">Email</th>
                        <th class="p-3 border text-left">Class</th>
                        <th class="p-3 border text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($students as $student)
                        <tr class="hover:bg-gray-50">
                            <td class="p-3 border">{{ $loop->iteration }}</td>
                            <td class="p-3 border">{{ $student->name }}</td>
                            <td class="p-3 border">{{ $student->email }}</td>
                            <td class="p-3 border">{{ $student->class }}</td>
                            <td class="p-3 border text-center">
                                <a href="{{ route('students.show', $student->id) }}"
                                   class="text-indigo-600 hover:text-indigo-800 mr-2">View</a>

                                @if(auth()->user()->role === 'admin')
                                    <a href="{{ route('students.edit', $student->id) }}"
                                       class="text-yellow-600 hover:text-yellow-800 mr-2">Edit</a>

                                    <form action="{{ route('students.destroy', $student->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            onclick="return confirm('Are you sure you want to delete this student?')"
                                            class="text-red-600 hover:text-red-800">
                                            Delete
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="p-3 text-center text-gray-500">No student data found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </x-card>
    </div>
</x-app-layout>