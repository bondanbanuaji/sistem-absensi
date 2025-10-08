<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight">Dashboard Guru</h2>
    </x-slot>

    <div class="py-6 max-w-6xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg p-6">
            <h3 class="text-lg font-semibold mb-3">Selamat datang, {{ Auth::user()->name }}!</h3>
            <p class="mb-4 text-gray-600">Rekap absensi hari ini</p>

            <div class="mb-4">
                <a href="{{ route('teacher.attendances.index') }}" class="px-4 py-2 bg-indigo-600 text-white rounded">Open Attendance Page</a>
            </div>

            <div class="overflow-x-auto mb-6">
                <table class="min-w-full text-left">
                    <thead class="bg-gray-100">
                        <tr><th class="p-2">Student</th><th class="p-2">Status</th><th class="p-2">Date</th></tr>
                    </thead>
                    <tbody>
                        @forelse ($todayAttendances as $at)
                            <tr><td class="p-2">{{ $at->student->name ?? '-' }}</td><td class="p-2">{{ $at->status }}</td><td class="p-2">{{ $at->date }}</td></tr>
                        @empty
                            <tr><td colspan="3" class="p-4 text-center">No attendance yet</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div>
                <canvas id="teacherAttendanceChart"></canvas>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('teacherAttendanceChart');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: @json($chartLabels ?? []),
                datasets: [{
                    label: 'Jumlah Kehadiran',
                    data: @json($chartData ?? []),
                    borderColor: 'rgb(99, 102, 241)',
                    tension: 0.3,
                    fill: true
                }]
            },
        });
    </script>
</x-app-layout>
