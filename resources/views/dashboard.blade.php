@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h1 class="mb-4 text-center">📊 Dashboard Absensi Sekolah</h1>

    <div class="row g-4 justify-content-center">
        <div class="col-md-3">
            <div class="card shadow text-center p-3 border-0" style="background-color: #f3f6ff;">
                <h5>Total Siswa</h5>
                <h2 class="text-primary">{{ $totalStudents }}</h2>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow text-center p-3 border-0" style="background-color: #e8fff1;">
                <h5>Absensi Hari Ini</h5>
                <h2 class="text-success">{{ $totalAttendancesToday }}</h2>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow text-center p-3 border-0" style="background-color: #fff8e5;">
                <h5>Persentase Kehadiran</h5>
                <h2 class="text-warning">{{ $attendancePercentage }}%</h2>
            </div>
        </div>
    </div>

    <div class="mt-5 text-center">
        <a href="{{ route('attendances.index') }}" class="btn btn-primary px-4">Lihat Data Absensi</a>
        <a href="{{ route('students.index') }}" class="btn btn-outline-secondary px-4">Kelola Siswa</a>
    </div>
</div>
@endsection