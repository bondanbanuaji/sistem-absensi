<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight">Dashboard Admin</h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <x-card title="Total Siswa">
                <p class="text-3xl mt-2 font-bold text-indigo-500">{{ $totalStudents ?? 0 }}</p>
            </x-card>

            <x-card title="Absensi Hari Ini">
                <p class="text-3xl mt-2 font-bold text-indigo-500">{{ $todayAttendances ?? 0 }}</p>
            </x-card>

            <x-card title="Quick Actions">
                <div class="space-y-2">
                    <a href="{{ route('students.index') }}" class="block px-4 py-2 bg-indigo-600 text-white rounded">Manage Students</a>
                    <a href="{{ route('attendances.index') }}" class="block px-4 py-2 bg-green-600 text-white rounded">Manage Attendances</a>
                </div>
            </x-card>
        </div>

        <x-card title="Grafik Kehadiran Minggu Ini" class="mt-6">
            <canvas id="attendanceChart"></canvas>
        </x-card>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('attendanceChart');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: @json($chartLabels ?? []),
                datasets: [{
                    label: 'Jumlah Kehadiran',
                    data: @json($chartData ?? []),
                    borderColor: 'rgb(99, 102, 241)',
                    backgroundColor: 'rgba(99, 102, 241, 0.15)',
                    tension: 0.3,
                    fill: true
                }]
            },
        });
    </script>
</x-app-layout>
