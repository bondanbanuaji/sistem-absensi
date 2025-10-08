<x-app-layout>
    <x-slot name="header"><h2 class="text-lg font-semibold">Edit Attendance</h2></x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto">
            <form method="POST" action="{{ route('attendances.update', $attendance) }}">
                @csrf @method('PUT')

                <div class="mb-3">
                    <label>Student</label>
                    <select name="student_id" class="w-full rounded border p-2">
                        @foreach($students as $s)
                            <option value="{{ $s->id }}" @if($s->id == $attendance->student_id) selected @endif>{{ $s->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label>Date</label>
                        <input type="date" name="date" class="w-full rounded border p-2" value="{{ $attendance->date->format('Y-m-d') }}">
                    </div>

                    <div>
                        <label>Status</label>
                        <select name="status" class="w-full rounded border p-2">
                            <option value="present" @if($attendance->status=='present') selected @endif>Present</option>
                            <option value="absent" @if($attendance->status=='absent') selected @endif>Absent</option>
                            <option value="sick" @if($attendance->status=='sick') selected @endif>Sick</option>
                            <option value="permission" @if($attendance->status=='permission') selected @endif>Permission</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-3 mt-3">
                    <div>
                        <label>Time In</label>
                        <input type="time" name="time_in" class="w-full rounded border p-2" value="{{ $attendance->time_in }}">
                    </div>
                    <div>
                        <label>Time Out</label>
                        <input type="time" name="time_out" class="w-full rounded border p-2" value="{{ $attendance->time_out }}">
                    </div>
                </div>

                <div class="mt-3">
                    <label>Note</label>
                    <input type="text" name="note" class="w-full rounded border p-2" value="{{ $attendance->note }}">
                </div>

                <div class="mt-4">
                    <button class="px-4 py-2 bg-indigo-600 text-white rounded">Update</button>
                    <a href="{{ route('attendances.index') }}" class="ml-2 text-gray-600">Back</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
