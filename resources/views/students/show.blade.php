<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold text-gray-800 dark:text-gray-100">
            {{ __('Student Detail') }}
        </h2>
    </x-slot>

    <div class="py-6 max-w-4xl mx-auto">
        <x-card>
            <p class="mb-2"><strong>Name:</strong> {{ $student->name }}</p>
            <p class="mb-2"><strong>Email:</strong> {{ $student->email }}</p>
            <p class="mb-2"><strong>Class:</strong> {{ $student->class }}</p>

            <a href="{{ route('students.index') }}"
               class="inline-block mt-4 bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition">
               Back
            </a>
        </x-card>
    </div>
</x-app-layout>
