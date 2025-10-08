<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Attendance;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function admin()
    {
        $totalStudents = Student::count();
        $today = Carbon::today();
        $todayAttendances = Attendance::whereDate('date', $today)->count();

        // gunakan groupByRaw supaya MySQL strict mode aman
        $attendanceStats = Attendance::selectRaw('DATE(date) as date, COUNT(*) as total')
            ->groupByRaw('DATE(date)')
            ->orderByRaw('DATE(date) asc')
            ->limit(7)
            ->get();

        $chartLabels = $attendanceStats->pluck('date')->map(fn($d) => (string) $d)->toArray();
        $chartData = $attendanceStats->pluck('total')->toArray();

        return view('dashboard.admin', compact('totalStudents', 'todayAttendances', 'chartLabels', 'chartData'));
    }

    public function teacher()
    {
        $today = Carbon::today();

        $todayAttendances = Attendance::with('student')
            ->whereDate('date', $today)
            ->get();

        $weeklyStats = Attendance::selectRaw('DATE(date) as date, COUNT(*) as total')
            ->groupByRaw('DATE(date)')
            ->orderByRaw('DATE(date) asc')
            ->limit(7)
            ->get();

        $chartLabels = $weeklyStats->pluck('date')->map(fn($d) => (string) $d)->toArray();
        $chartData = $weeklyStats->pluck('total')->toArray();

        return view('dashboard.teacher', compact('todayAttendances', 'chartLabels', 'chartData'));
    }

    public function student()
    {
        $user = Auth::user();

        // kalau pakai user->student relasi: Student::where('user_id',$user->id)
        $student = Student::where('user_id', $user->id)->first();

        $attendances = $student
            ? Attendance::where('student_id', $student->id)->latest()->take(10)->get()
            : collect();

        // map status to angka sederhana (display chart)
        $statusMap = [
            'present' => 1,
            'absent' => 0,
            'sick' => 0.5,
            'permission' => 0.7,
        ];

        $chartLabels = $attendances->pluck('date')->map(fn($d) => $d->format('Y-m-d'))->toArray();
        $chartData = $attendances->pluck('status')->map(fn($s) => $statusMap[$s] ?? 0)->toArray();

        return view('dashboard.student', compact('student', 'attendances', 'chartLabels', 'chartData'));
    }
}
