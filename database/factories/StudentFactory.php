<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Student;

class StudentFactory extends Factory
{
    protected $model = Student::class;

    public function definition()
    {
        return [
            'nis' => $this->faker->unique()->numerify('2###'),
            'name' => $this->faker->name(),
            'kelas' => $this->faker->randomElement(['10A','10B','11A','11B','12A']),
            'phone' => $this->faker->phoneNumber(),
        ];
    }
}
