<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold text-gray-800 dark:text-gray-100">
            {{ __('Add Attendance') }}
        </h2>
    </x-slot>

    <div class="py-6 max-w-4xl mx-auto">
        <x-alert />

        <x-card>
            <form method="POST" action="{{ route('attendances.store') }}">
                @csrf

                <div class="mb-4">
                    <label class="block text-gray-700">Student</label>
                    <select name="student_id" class="w-full border-gray-300 rounded-lg mt-2">
                        @foreach ($students as $student)
                            <option value="{{ $student->id }}">{{ $student->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700">Date</label>
                    <input type="date" name="date" class="w-full border-gray-300 rounded-lg mt-2">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700">Status</label>
                    <select name="status" class="w-full border-gray-300 rounded-lg mt-2">
                        <option value="Present">Present</option>
                        <option value="Absent">Absent</option>
                    </select>
                </div>

                <button type="submit"
                    class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition">
                    Save
                </button>
            </form>
        </x-card>
    </div>
</x-app-layout>
