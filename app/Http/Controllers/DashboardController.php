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
        $todayAttendances = Attendance::whereDate('created_at', $today)->count();

        $attendanceStats = Attendance::selectRaw('DATE(created_at) as date, COUNT(id) as total')
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

        $todayAttendances = Attendance::whereDate('created_at', $today)->get();
        $totalAttendances = Attendance::count();

        return view('dashboard.teacher', compact('todayAttendances', 'totalAttendances'));
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

        // Untuk chart
        $chartLabels = $attendances->pluck('created_at')->map(function ($d) {
            return $d->format('Y-m-d');
        })->toArray();
        $chartData = $attendances->pluck('status')->toArray(); // misal status hadir

        return view('dashboard.student', compact('student', 'attendances', 'chartLabels', 'chartData'));
    }
}