<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\DashboardController;

// Halaman dashboard utama
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Redirect root ke halaman absensi
Route::get('/', function () {
    return redirect()->route('attendances.index');
});

// CRUD Siswa
Route::resource('students', StudentController::class);

// CRUD Absensi
Route::resource('attendances', AttendanceController::class);

// Filter absensi berdasarkan tanggal (optional)
Route::get('/attendances/filter', [AttendanceController::class, 'filter'])->name('attendances.filter');

// Cek koneksi database (debug)
Route::get('/check-db', function () {
    try {
        \DB::connection()->getPdo();
        return '✅ Database terkoneksi: ' . \DB::connection()->getDatabaseName();
    } catch (\Exception $e) {
        return '❌ Gagal konek database: ' . $e->getMessage();
    }
});