<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Doctor;
use Illuminate\Database\Seeder;

class DoctorSeeder extends Seeder
{
    public function run(): void
    {
        $doctors = [
            ['name' => 'Dr. Antonio Ramos', 'specialization' => 'Cardiology', 'email' => 'antonio@example.com', 'phone' => '09123456789'],
            ['name' => 'Dr. Liza Santos', 'specialization' => 'Pediatrics', 'email' => 'liza@example.com', 'phone' => '09123456780'],
            ['name' => 'Dr. Carlo Cruz', 'specialization' => 'General Medicine', 'email' => 'carlo@example.com', 'phone' => '09123456781'],
            ['name' => 'Dr. Karen Lim', 'specialization' => 'Dermatology', 'email' => 'karen@example.com', 'phone' => '09123456782'],
            ['name' => 'Dr. Miguel Dela Vega', 'specialization' => 'Orthopedics', 'email' => 'miguel@example.com', 'phone' => '09123456783'],
            ['name' => 'Dr. Anne Vega', 'specialization' => 'Orthopedics', 'email' => 'anne@example.com', 'phone' => '09123456783'],
            ['name' => 'Dr. Mark Josh Villa', 'specialization' => 'Orthopedics', 'email' => 'mark@example.com', 'phone' => '09123456783'],
            ['name' => 'Dr. John Doe', 'specialization' => 'General Medicine', 'email' => 'josn@example.com', 'phone' => '09123456783'],
            ['name' => 'Dr. Lea Suarez', 'specialization' => 'Orthopedics', 'email' => 'lea@example.com', 'phone' => '09123456783'],
            ['name' => 'Dr. Ariel Kim', 'specialization' => 'Pediatrics', 'email' => 'ariel@example.com', 'phone' => '09123456783'],
        ];

        foreach ($doctors as $doctor) {
            Doctor::create($doctor);
        }
    }
}
