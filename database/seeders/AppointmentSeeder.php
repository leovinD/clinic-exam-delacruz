<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Appointment;
use App\Models\Patient;
use App\Models\Doctor;
use Illuminate\Database\Seeder;

class AppointmentSeeder extends Seeder
{
    public function run(): void
    {
        $patientIds = Patient::pluck('id')->toArray();
        $doctorIds = Doctor::pluck('id')->toArray();
        $statuses = ['Scheduled', 'Completed', 'Cancelled'];

        foreach (range(1, 20) as $index) {
            Appointment::create([
                'patient_id' => $patientIds[array_rand($patientIds)],
                'doctor_id' => $doctorIds[array_rand($doctorIds)],
                'appointment_date' => now()->addDays(rand(1, 20)),
                'status' => $statuses[array_rand($statuses)],
            ]);
        }
    }
}
