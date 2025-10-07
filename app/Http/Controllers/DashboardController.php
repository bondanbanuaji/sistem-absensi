<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Attendance;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Hitung jumlah siswa
        $totalStudents = Student::count();

        // Hitung jumlah absensi hari ini
        $today = now()->toDateString();
        $totalAttendancesToday = Attendance::whereDate('created_at', $today)->count();

        // Persentase kehadiran (jika ada data)
        $attendancePercentage = $totalStudents > 0
            ? round(($totalAttendancesToday / $totalStudents) * 100, 2)
            : 0;

        // Kirim data ke view
        return view('dashboard', compact('totalStudents', 'totalAttendancesToday', 'attendancePercentage'));
    }
}