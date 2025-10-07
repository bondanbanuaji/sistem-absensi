<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Database\Seeders\StudentSeeder;
use Database\Seeders\AttendanceSeeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // buat user test dengan aman (tidak duplikat)
        User::updateOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'password' => bcrypt('password'), // ganti sesuai kebutuhan
                'email_verified_at' => now(),
            ]
        );

        // panggil seeders lain
        $this->call([
            StudentSeeder::class,
            AttendanceSeeder::class,
        ]);
    }
}