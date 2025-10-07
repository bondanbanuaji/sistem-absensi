<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Attendance;
use App\Models\Student;

class AttendanceSeeder extends Seeder
{
    public function run(): void
    {
        $date = today()->toDateString();

        foreach (Student::all() as $student) {
            Attendance::updateOrCreate(
                ['student_id' => $student->id, 'date' => $date],
                [
                    'status' => 'present',
                    'time_in' => now()->format('H:i'),
                    'time_out' => null,
                    'note' => null,
                ]
            );
        }
    }
}
