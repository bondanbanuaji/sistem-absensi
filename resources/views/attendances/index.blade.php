<x-app-layout>
    <x-slot name="header"><h2 class="text-lg font-semibold">Attendances</h2></x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-4 flex justify-between items-center">
                <form method="GET" class="flex gap-2">
                    <input type="date" name="date" value="{{ request('date') }}" class="rounded border px-2 py-1">
                    <input type="text" name="name" placeholder="Search student" value="{{ request('name') }}" class="rounded border px-2 py-1">
                    <button class="px-3 py-1 bg-indigo-600 text-white rounded">Filter</button>
                </form>

                <div>
                    <a href="{{ route('attendances.create') }}" class="px-4 py-2 bg-green-600 text-white rounded">+ New Attendance</a>
                </div>
            </div>

            <div class="bg-white shadow sm:rounded-lg overflow-hidden">
                <table class="min-w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="p-2">Student</th>
                            <th class="p-2">Status</th>
                            <th class="p-2">Date</th>
                            <th class="p-2">Time In</th>
                            <th class="p-2">Time Out</th>
                            <th class="p-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($attendances as $a)
                            <tr class="border-t">
                                <td class="p-2">{{ $a->student->name ?? '-' }}</td>
                                <td class="p-2">{{ ucfirst($a->status) }}</td>
                                <td class="p-2">{{ $a->date->format('Y-m-d') }}</td>
                                <td class="p-2">{{ $a->time_in }}</td>
                                <td class="p-2">{{ $a->time_out }}</td>
                                <td class="p-2">
                                    <a href="{{ route('attendances.edit', $a) }}" class="text-indigo-600">Edit</a>
                                    <form action="{{ route('attendances.destroy', $a) }}" method="POST" class="inline-block" onsubmit="return confirm('Delete?')">
                                        @csrf @method('DELETE')
                                        <button class="text-red-600 ml-2">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="p-4">
                    {{ $attendances->withQueryString()->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
