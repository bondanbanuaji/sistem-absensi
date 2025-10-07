<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            Dashboard
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="p-6 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                    <h3 class="text-lg font-semibold">Total Siswa</h3>
                    <p class="text-3xl mt-2">{{ $totalStudents }}</p>
                </div>

                <div class="p-6 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                    <h3 class="text-lg font-semibold">Absensi Hari Ini</h3>
                    <p class="text-3xl mt-2">{{ $todayAttendances }}</p>
                </div>
            </div>

            {{-- Grafik Kehadiran --}}
            <div class="p-6 bg-white dark:bg-gray-800 shadow sm:rounded-lg mt-6">
                <h3 class="text-lg font-semibold mb-4">Grafik Kehadiran Minggu Ini</h3>
                <canvas id="attendanceChart" width="400" height="200"></canvas>
            </div>
        </div>
    </div>

    {{-- Chart.js --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('attendanceChart').getContext('2d');
        const attendanceChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: @json($chartLabels),
                datasets: [{
                    label: 'Jumlah Kehadiran',
                    data: @json($chartData),
                    borderColor: 'rgb(75, 192, 192)',
                    tension: 0.3,
                    fill: true
                }]
            },
        });
    </script>
</x-app-layout>