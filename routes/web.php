<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Home / root -> redirect ke dashboard (role-aware) atau login
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

// Global dashboard redirect route (authenticated)
Route::get('/dashboard', function () {
    $user = Auth::user();
    if (!$user) return redirect()->route('login');

    return match ($user->role) {
        'admin' => redirect()->route('dashboard.admin'),
        'teacher' => redirect()->route('dashboard.teacher'),
        'student' => redirect()->route('dashboard.student'),
        default => redirect()->route('login'),
    };
})->middleware('auth')->name('dashboard');

// ===== ADMIN (CRUD penuh untuk students & attendances) =====
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard/admin', [DashboardController::class, 'admin'])->name('dashboard.admin');

    // admin can manage students & attendances via standard resource route names
    Route::resource('students', StudentController::class);
    Route::resource('attendances', AttendanceController::class);
});

// ===== TEACHER (lihat & manage absensi saja) =====
Route::middleware(['auth', 'role:teacher'])->group(function () {
    Route::get('/dashboard/teacher', [DashboardController::class, 'teacher'])->name('dashboard.teacher');

    // teacher view for attendances (index with teacher-level privileges)
    Route::get('/teacher/attendances', [AttendanceController::class, 'teacherIndex'])->name('teacher.attendances.index');

    // teacher can store/edit/update via same controller but route names are standard (POST to attendances.store, etc.)
    Route::post('/teacher/attendances', [AttendanceController::class, 'store'])->name('teacher.attendances.store');
    Route::get('/teacher/attendances/create', [AttendanceController::class, 'create'])->name('teacher.attendances.create');
    Route::get('/teacher/attendances/{attendance}/edit', [AttendanceController::class, 'edit'])->name('teacher.attendances.edit');
    Route::put('/teacher/attendances/{attendance}', [AttendanceController::class, 'update'])->name('teacher.attendances.update');
    Route::delete('/teacher/attendances/{attendance}', [AttendanceController::class, 'destroy'])->name('teacher.attendances.destroy');
});

// ===== STUDENT (lihat riwayat sendiri) =====
Route::middleware(['auth', 'role:student'])->group(function () {
    Route::get('/dashboard/student', [DashboardController::class, 'student'])->name('dashboard.student');
    Route::get('/student/attendances', [AttendanceController::class, 'studentIndex'])->name('student.attendances.index');
});

// ===== PROFILE (semua role) =====
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Auth routes (Breeze/Jetstream-generated)
require __DIR__.'/auth.php';