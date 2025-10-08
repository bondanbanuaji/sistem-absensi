<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    public function index()
    {
        // admin only
        if (auth()->user()->role !== 'admin') abort(403);

        $students = Student::orderBy('name')->paginate(10);
        return view('students.index', compact('students'));
    }

    public function create()
    {
        if (auth()->user()->role !== 'admin') abort(403);
        return view('students.create');
    }

    public function store(Request $request)
    {
        if (auth()->user()->role !== 'admin') abort(403);

        $data = $request->validate([
            'user_id' => 'nullable|exists:users,id',
            'nis'   => 'required|unique:students,nis',
            'name'  => 'required|string|max:100',
            'kelas' => 'nullable|string|max:50',
            'phone' => 'nullable|string|max:20',
            'photo' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('students', 'public');
        }

        Student::create($data);

        return redirect()->route('students.index')->with('success', 'Siswa berhasil ditambahkan.');
    }

    public function show(Student $student)
    {
        if (auth()->user()->role !== 'admin') abort(403);
        return view('students.show', compact('student'));
    }

    public function edit(Student $student)
    {
        if (auth()->user()->role !== 'admin') abort(403);
        return view('students.edit', compact('student'));
    }

    public function update(Request $request, Student $student)
    {
        if (auth()->user()->role !== 'admin') abort(403);

        $data = $request->validate([
            'user_id' => 'nullable|exists:users,id',
            'nis'   => 'required|unique:students,nis,' . $student->id,
            'name'  => 'required|string|max:100',
            'kelas' => 'nullable|string|max:50',
            'phone' => 'nullable|string|max:20',
            'photo' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('students', 'public');
        }

        $student->update($data);

        return redirect()->route('students.index')->with('success', 'Data siswa diperbarui.');
    }

    public function destroy(Student $student)
    {
        if (auth()->user()->role !== 'admin') abort(403);
        $student->delete();
        return redirect()->route('students.index')->with('success', 'Siswa dihapus.');
    }
}