<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\ProfileController;

// ===== DEFAULT REDIRECT / HOME =====
Route::get('/', function () {
    if (Auth::check()) {
        $user = Auth::user();

        return match ($user->role) {
            'admin' => redirect()->route('dashboard.admin'),
            'teacher' => redirect()->route('dashboard.teacher'),
            'student' => redirect()->route('dashboard.student'),
            default => redirect()->route('login'),
        };
    }

    return redirect()->route('login');
});

// ===== GLOBAL DASHBOARD ROUTE (AMAN UNTUK SEMUA ROLE) =====
Route::get('/dashboard', function () {
    $user = Auth::user();
    if (!$user) {
        return redirect()->route('login');
    }

    return match ($user->role) {
        'admin' => redirect()->route('dashboard.admin'),
        'teacher' => redirect()->route('dashboard.teacher'),
        'student' => redirect()->route('dashboard.student'),
        default => redirect()->route('login'),
    };
})->middleware('auth')->name('dashboard');


// ===== ROLE: ADMIN =====
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard/admin', [DashboardController::class, 'admin'])->name('dashboard.admin');
    Route::resource('/students', StudentController::class);
    Route::resource('/attendances', AttendanceController::class);
});

// ===== ROLE: TEACHER =====
Route::middleware(['auth', 'role:teacher'])->group(function () {
    Route::get('/dashboard/teacher', [DashboardController::class, 'teacher'])->name('dashboard.teacher');
    Route::get('/attendances', [AttendanceController::class, 'index'])->name('teacher.attendance.index');
});

// ===== ROLE: STUDENT =====
Route::middleware(['auth', 'role:student'])->group(function () {
    Route::get('/dashboard/student', [DashboardController::class, 'student'])->name('dashboard.student');
});

// ===== PROFILE (semua role bisa akses) =====
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ===== AUTH ROUTES =====
require __DIR__.'/auth.php';