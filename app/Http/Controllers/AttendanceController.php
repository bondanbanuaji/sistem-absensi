<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Attendance;
use App\Models\Student;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // === ADMIN: Full list (dengan filter tanggal/nama) ===
    public function index(Request $request)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized.');
        }

        $query = Attendance::with('student');

        if ($request->filled('date')) {
            $query->whereDate('date', $request->date);
        }

        if ($request->filled('name')) {
            $query->whereHas('student', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->name . '%');
            });
        }

        $attendances = $query->latest('date')->paginate(10);

        return view('attendances.index', compact('attendances'));
    }

    // === TEACHER: List absensi (khusus guru) ===
    public function teacherIndex(Request $request)
    {
        if (Auth::user()->role !== 'teacher') {
            abort(403, 'Unauthorized.');
        }

        $query = Attendance::with('student');

        if ($request->filled('date')) {
            $query->whereDate('date', $request->date);
        }

        if ($request->filled('name')) {
            $query->whereHas('student', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->name . '%');
            });
        }

        $attendances = $query->latest('date')->paginate(10);

        return view('teacher.attendances.index', compact('attendances'));
    }

    // === STUDENT: Riwayat absensi sendiri ===
    public function studentIndex()
    {
        if (Auth::user()->role !== 'student') {
            abort(403, 'Unauthorized.');
        }

        $student = Student::where('user_id', Auth::id())->first();

        if (!$student) {
            return back()->with('error', 'Data siswa tidak ditemukan.');
        }

        $attendances = Attendance::where('student_id', $student->id)
            ->orderByDesc('date')
            ->paginate(10);

        return view('student.attendances.index', compact('attendances', 'student'));
    }

    // === CREATE ===
    public function create()
    {
        if (!in_array(Auth::user()->role, ['admin', 'teacher'])) abort(403);
        $students = Student::orderBy('name')->get();
        return view('attendances.create', compact('students'));
    }

    // === STORE ===
    public function store(Request $request)
    {
        if (!in_array(Auth::user()->role, ['admin', 'teacher'])) abort(403);

        $data = $request->validate([
            'student_id' => 'required|exists:students,id',
            'date' => 'required|date',
            'status' => 'required|in:present,absent,sick,permission',
            'time_in' => 'nullable|date_format:H:i',
            'time_out' => 'nullable|date_format:H:i',
            'note' => 'nullable|string|max:255',
        ]);

        $recordedBy = Auth::id();

        Attendance::updateOrCreate(
            ['student_id' => $data['student_id'], 'date' => $data['date']],
            array_merge($data, ['recorded_by' => $recordedBy])
        );

        return redirect()->route(
            Auth::user()->role === 'teacher'
                ? 'teacher.attendances.index'
                : 'attendances.index'
        )->with('success', 'Absensi berhasil disimpan.');
    }

    // === EDIT ===
    public function edit(Attendance $attendance)
    {
        if (!in_array(Auth::user()->role, ['admin', 'teacher'])) abort(403);
        $students = Student::orderBy('name')->get();
        return view('attendances.edit', compact('attendance', 'students'));
    }

    // === UPDATE ===
    public function update(Request $request, Attendance $attendance)
    {
        if (!in_array(Auth::user()->role, ['admin', 'teacher'])) abort(403);

        $data = $request->validate([
            'student_id' => 'required|exists:students,id',
            'date' => 'required|date',
            'status' => 'required|in:present,absent,sick,permission',
            'time_in' => 'nullable|date_format:H:i',
            'time_out' => 'nullable|date_format:H:i',
            'note' => 'nullable|string|max:255',
        ]);

        $attendance->update($data);

        return redirect()->route(
            Auth::user()->role === 'teacher'
                ? 'teacher.attendances.index'
                : 'attendances.index'
        )->with('success', 'Data absensi berhasil diperbarui.');
    }

    // === DESTROY ===
    public function destroy(Attendance $attendance)
    {
        if (!in_array(Auth::user()->role, ['admin', 'teacher'])) abort(403);
        $attendance->delete();

        return redirect()->route(
            Auth::user()->role === 'teacher'
                ? 'teacher.attendances.index'
                : 'attendances.index'
        )->with('success', 'Absensi berhasil dihapus.');
    }
}