<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            Dashboard Guru
        </h2>
    </x-slot>

    <div class="py-6 max-w-6xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg p-6">
            <h3 class="text-lg font-semibold mb-3">Selamat datang, {{ Auth::user()->name }}!</h3>
            <p class="text-gray-600 dark:text-gray-300 mb-4">Berikut rekap absensi siswa hari ini:</p>

            <div class="overflow-x-auto">
                <table class="min-w-full text-left border border-gray-700 rounded-lg">
                    <thead class="bg-gray-100 dark:bg-gray-700">
                        <tr>
                            <th class="py-2 px-4">Nama Siswa</th>
                            <th class="py-2 px-4">Status</th>
                            <th class="py-2 px-4">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($todayAttendances as $attendance)
                            <tr class="border-b dark:border-gray-700">
                                <td class="py-2 px-4">{{ $attendance->student->name ?? '-' }}</td>
                                <td class="py-2 px-4 capitalize">{{ $attendance->status }}</td>
                                <td class="py-2 px-4">{{ $attendance->date }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center py-3 text-gray-500 dark:text-gray-400">Belum ada data absensi hari ini.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Chart --}}
            <div class="mt-8">
                <h3 class="text-lg font-semibold mb-4">Grafik Kehadiran Minggu Ini</h3>
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