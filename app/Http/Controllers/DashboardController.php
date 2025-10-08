<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Attendance;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Dashboard Admin
     */
    public function admin()
    {
        $totalStudents = Student::count();
        $today = Carbon::today();
        $todayAttendances = Attendance::whereDate('date', $today)->count();

        $attendanceStats = Attendance::selectRaw('DATE(date) as date, COUNT(id) as total')
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->limit(7)
            ->get();

        $chartLabels = $attendanceStats->pluck('date')->toArray();
        $chartData = $attendanceStats->pluck('total')->toArray();

        return view('dashboard.admin', compact(
            'totalStudents',
            'todayAttendances',
            'chartLabels',
            'chartData'
        ));
    }

    /**
     * Dashboard Teacher
     */
    public function teacher()
    {
        $today = Carbon::today();

        $todayAttendances = Attendance::with('student')
            ->whereDate('date', $today)
            ->get();

        $weeklyStats = Attendance::selectRaw('DATE(date) as date, COUNT(id) as total')
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->limit(7)
            ->get();

        $chartLabels = $weeklyStats->pluck('date')->toArray();
        $chartData = $weeklyStats->pluck('total')->toArray();

        return view('dashboard.teacher', compact(
            'todayAttendances',
            'chartLabels',
            'chartData'
        ));
    }

    /**
     * Dashboard Student
     */
    public function student()
    {
        $user = Auth::user();
        $student = Student::where('user_id', $user->id)->first();

        $attendances = $student
            ? Attendance::where('student_id', $student->id)->latest()->take(10)->get()
            : collect();

        // Konversi status ke angka (buat grafik)
        $statusMap = [
            'present' => 1,
            'absent' => 0,
            'sick' => 0.5,
            'permission' => 0.7,
        ];

        $chartLabels = $attendances->pluck('date')->toArray();
        $chartData = $attendances->pluck('status')->map(fn($s) => $statusMap[$s] ?? 0)->toArray();

        return view('dashboard.student', compact('student', 'attendances', 'chartLabels', 'chartData'));
    }
}