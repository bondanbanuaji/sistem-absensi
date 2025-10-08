<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight">Dashboard Siswa</h2>
    </x-slot>

    <div class="py-6 max-w-5xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
            <h3 class="text-lg font-semibold">Halo, {{ Auth::user()->name }}!</h3>
            <p class="text-gray-600 mb-4">Rekap absensi mingguanmu:</p>

            <div>
                <canvas id="studentAttendanceChart"></canvas>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('studentAttendanceChart');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: @json($chartLabels ?? []),
                datasets: [{
                    label: 'Kehadiran',
                    data: @json($chartData ?? []),
                    borderColor: 'rgba(99,102,241,1)',
                    backgroundColor: 'rgba(99,102,241,0.7)',
                    borderWidth: 1
                }]
            },
        });
    </script>
</x-app-layout>
