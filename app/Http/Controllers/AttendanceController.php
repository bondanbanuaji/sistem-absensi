<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Student;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index(Request $request)
    {
        $date = $request->query('date', date('Y-m-d'));
        $attendances = Attendance::with('student')
            ->where('date', $date)
            ->orderBy('student_id')
            ->get();

        return view('attendances.index', compact('attendances', 'date'));
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
            'date'       => 'required|date',
            'status'     => 'required|in:present,absent,sick,permission',
            'time_in'    => 'nullable|date_format:H:i',
            'time_out'   => 'nullable|date_format:H:i',
            'note'       => 'nullable|string|max:255',
        ]);

        Attendance::updateOrCreate(
            ['student_id' => $data['student_id'], 'date' => $data['date']],
            array_merge($data, ['recorded_by' => auth()->id() ?? null])
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
            'date'       => 'required|date',
            'status'     => 'required|in:present,absent,sick,permission',
            'time_in'    => 'nullable|date_format:H:i',
            'time_out'   => 'nullable|date_format:H:i',
            'note'       => 'nullable|string|max:255',
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