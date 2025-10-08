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
        // admin-only for the resource index and full CRUD
        // teacher can access teacherIndex and store/edit/update/destroy via routes defined for teacher
    }

    // Admin: full list (with filters)
    public function index(Request $request)
    {
        // guard: ensure admin or teacher (depending on how you want)
        if (Auth::user()->role !== 'admin') {
            abort(403);
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

    // Teacher generic listing (dedicated view)
    public function teacherIndex(Request $request)
    {
        if (Auth::user()->role !== 'teacher') {
            abort(403);
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

    // Student: own history
    public function studentIndex()
    {
        if (Auth::user()->role !== 'student') {
            abort(403);
        }

        $student = Student::where('user_id', Auth::id())->first();
        $attendances = $student
            ? Attendance::where('student_id', $student->id)->orderByDesc('date')->paginate(10)
            : collect();

        return view('student.attendances.index', compact('attendances', 'student'));
    }

    public function create()
    {
        // admin or teacher can create
        if (!in_array(Auth::user()->role, ['admin','teacher'])) abort(403);
        $students = Student::orderBy('name')->get();
        return view('attendances.create', compact('students'));
    }

    public function store(Request $request)
    {
        if (!in_array(Auth::user()->role, ['admin','teacher'])) abort(403);

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

        // redirect back to appropriate index depending on role
        if (Auth::user()->role === 'teacher') {
            return redirect()->route('teacher.attendances.index')->with('success', 'Absensi tersimpan.');
        }

        return redirect()->route('attendances.index')->with('success', 'Absensi tersimpan.');
    }

    public function edit(Attendance $attendance)
    {
        if (!in_array(Auth::user()->role, ['admin','teacher'])) abort(403);
        $students = Student::orderBy('name')->get();
        return view('attendances.edit', compact('attendance', 'students'));
    }

    public function update(Request $request, Attendance $attendance)
    {
        if (!in_array(Auth::user()->role, ['admin','teacher'])) abort(403);

        $data = $request->validate([
            'student_id' => 'required|exists:students,id',
            'date' => 'required|date',
            'status' => 'required|in:present,absent,sick,permission',
            'time_in' => 'nullable|date_format:H:i',
            'time_out' => 'nullable|date_format:H:i',
            'note' => 'nullable|string|max:255',
        ]);

        $attendance->update($data);

        // redirect to role-appropriate index
        if (Auth::user()->role === 'teacher') {
            return redirect()->route('teacher.attendances.index')->with('success', 'Data absensi diperbarui.');
        }

        return redirect()->route('attendances.index')->with('success', 'Data absensi diperbarui.');
    }

    public function destroy(Attendance $attendance)
    {
        if (!in_array(Auth::user()->role, ['admin','teacher'])) abort(403);
        $attendance->delete();
        if (Auth::user()->role === 'teacher') {
            return redirect()->route('teacher.attendances.index')->with('success', 'Absensi dihapus.');
        }
        return redirect()->route('attendances.index')->with('success', 'Absensi dihapus.');
    }
}