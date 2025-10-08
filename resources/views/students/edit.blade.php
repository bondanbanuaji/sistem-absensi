<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold text-gray-800 dark:text-gray-100">
            {{ __('Edit Student') }}
        </h2>
    </x-slot>

    <div class="py-6 max-w-4xl mx-auto">
        <x-alert />

        <x-card>
            <form method="POST" action="{{ route('students.update', $student->id) }}">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="block text-gray-700">Name</label>
                    <input type="text" name="name" value="{{ $student->name }}"
                           class="w-full border-gray-300 rounded-lg mt-2" required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700">Email</label>
                    <input type="email" name="email" value="{{ $student->email }}"
                           class="w-full border-gray-300 rounded-lg mt-2" required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700">Class</label>
                    <input type="text" name="class" value="{{ $student->class }}"
                           class="w-full border-gray-300 rounded-lg mt-2">
                </div>

                <button type="submit"
                    class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition">
                    Update
                </button>
            </form>
        </x-card>
    </div>
</x-app-layout>
