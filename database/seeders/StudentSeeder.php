<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Student;
use Illuminate\Support\Facades\DB;

class StudentSeeder extends Seeder
{
    public function run(): void
    {
        // Jika mau mulai bersih (dev only), gunakan truncate dengan nonaktifkan FK
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Student::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $students = [
            ['nis' => '1001', 'name' => 'Ahmad', 'kelas' => '10A', 'phone' => '081234567890'],
            ['nis' => '1002', 'name' => 'Budi',  'kelas' => '10A', 'phone' => '081234567891'],
            ['nis' => '1003', 'name' => 'Cici',  'kelas' => '10B', 'phone' => '081234567892'],
            // tambah sesuai kebutuhan
        ];

        foreach ($students as $s) {
            Student::updateOrCreate(
                ['nis' => $s['nis']], // key unik
                $s
            );
        }
    }
}