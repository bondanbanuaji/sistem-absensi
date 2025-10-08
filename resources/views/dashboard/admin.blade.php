<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            Dashboard Admin
        </h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

        {{-- Statistik --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <x-card title="Total Siswa">
                <p class="text-3xl mt-2 font-bold text-indigo-500">{{ $totalStudents ?? 0 }}</p>
            </x-card>

            <x-card title="Absensi Hari Ini">
                <p class="text-3xl mt-2 font-bold text-indigo-500">{{ $todayAttendances ?? 0 }}</p>
            </x-card>
        </div>

        {{-- Navigasi CRUD --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
            <a href="{{ route('students.index') }}" class="block p-6 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-2xl shadow-lg transition duration-200 ease-in-out transform hover:-translate-y-1">
                <h3 class="text-xl mb-2">👨‍🎓 Kelola Data Siswa</h3>
                <p class="text-sm opacity-90">Lihat, tambah, ubah, atau hapus data siswa.</p>
            </a>

            <a href="{{ route('attendances.index') }}" class="block p-6 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-2xl shadow-lg transition duration-200 ease-in-out transform hover:-translate-y-1">
                <h3 class="text-xl mb-2">🗓️ Kelola Absensi</h3>
                <p class="text-sm opacity-90">Atur dan pantau kehadiran siswa setiap hari.</p>
            </a>
        </div>

        {{-- Chart --}}
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
                    backgroundColor: 'rgba(99, 102, 241, 0.2)',
                    tension: 0.3,
                    fill: true
                }]
            },
        });
    </script>
</x-app-layout>