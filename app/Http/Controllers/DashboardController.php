<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Attendance;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalStudents = Student::count();

        $today = Carbon::today();
        $todayAttendances = Attendance::whereDate('created_at', $today)->count();

        // Data untuk chart (7 hari terakhir)
        $attendanceStats = Attendance::selectRaw('DATE(created_at) as date, COUNT(id) as total')
            ->groupByRaw('DATE(created_at)')
            ->orderByRaw('DATE(created_at) asc')
            ->limit(7)
            ->get();

        // Ubah ke format chart-friendly
        $chartLabels = $attendanceStats->pluck('date')->toArray();
        $chartData = $attendanceStats->pluck('total')->toArray();

        return view('dashboard', compact(
            'totalStudents',
            'todayAttendances',
            'chartLabels',
            'chartData'
        ));
    }
}