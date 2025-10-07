<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Attendance;
use App\Models\Student;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index(Request $request)
    {
        $query = Attendance::with('student');

        // Filter berdasarkan tanggal
        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        // Pencarian berdasarkan nama siswa
        if ($request->filled('name')) {
            $query->whereHas('student', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->name . '%');
            });
        }

        $attendances = $query->latest()->paginate(10);

        return view('attendances.index', compact('attendances'));
    }


    public function create()
    {
        $students = Student::orderBy('name')->get();
        return view('attendances.create', compact('students'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'student_id' => 'required|exists:students,id',
            'date' => 'required|date',
            'status' => 'required|in:present,absent,sick,permission',
            'time_in' => 'nullable|date_format:H:i',
            'time_out' => 'nullable|date_format:H:i',
            'note' => 'nullable|string|max:255',
        ]);

        $recordedBy = Auth::check() ? Auth::user()->id : null;

        Attendance::updateOrCreate(
            ['student_id' => $data['student_id'], 'date' => $data['date']],
            array_merge($data, ['recorded_by' => $recordedBy])
        );

        return redirect()->route('attendances.index', ['date' => $data['date']])
            ->with('success', 'Absensi tersimpan.');
    }

    public function edit(Attendance $attendance)
    {
        $students = Student::orderBy('name')->get();
        return view('attendances.edit', compact('attendance', 'students'));
    }

    public function update(Request $request, Attendance $attendance)
    {
        $data = $request->validate([
            'student_id' => 'required|exists:students,id',
            'date' => 'required|date',
            'status' => 'required|in:present,absent,sick,permission',
            'time_in' => 'nullable|date_format:H:i',
            'time_out' => 'nullable|date_format:H:i',
            'note' => 'nullable|string|max:255',
        ]);

        $attendance->update($data);

        return redirect()->route('attendances.index')->with('success', 'Data absensi diperbarui.');
    }

    public function destroy(Attendance $attendance)
    {
        $attendance->delete();
        return redirect()->route('attendances.index')->with('success', 'Absensi dihapus.');
    }
}