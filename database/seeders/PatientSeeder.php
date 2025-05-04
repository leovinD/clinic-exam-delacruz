<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Patient;

class PatientSeeder extends Seeder
{
    public function run(): void
    {
        $patients = [
            ['name' => 'Juan Dela Cruz', 'email' => 'juan@example.com', 'phone' => '09123456789', 'birth_date' => '1990-01-15'],
            ['name' => 'Maria Santos', 'email' => 'maria@example.com', 'phone' => '09123456780', 'birth_date' => '1995-02-25'],
            ['name' => 'Carlos Reyes', 'email' => 'carlos@example.com', 'phone' => '09123456781', 'birth_date' => '1980-05-10'],
            ['name' => 'Anna Lopez', 'email' => 'anna@example.com', 'phone' => '09123456782', 'birth_date' => '2000-07-18'],
            ['name' => 'Josefina Mendoza', 'email' => 'josefina@example.com', 'phone' => '09123456783', 'birth_date' => '1965-11-30'],
            ['name' => 'Michael Tan', 'email' => 'michael@example.com', 'phone' => '09123456784', 'birth_date' => '1985-09-14'],
            ['name' => 'Sophia Lim', 'email' => 'sophia@example.com', 'phone' => '09123456785', 'birth_date' => '1980-03-02'],
            ['name' => 'Mark Villanueva', 'email' => 'mark@example.com', 'phone' => '09123456786', 'birth_date' => '1992-12-05'],
            ['name' => 'Diana Cruz', 'email' => 'diana@example.com', 'phone' => '09123456787', 'birth_date' => '1998-04-20'],
            ['name' => 'Luis Bautista', 'email' => 'luis@example.com', 'phone' => '09123456788', 'birth_date' => '1975-06-30'],
        ];

        foreach ($patients as $patient) {
            Patient::create($patient);
        }
    }
}
