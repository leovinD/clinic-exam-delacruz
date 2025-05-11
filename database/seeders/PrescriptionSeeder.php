<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Prescription;
use App\Models\Patient;
use App\Models\Doctor;
use App\Models\Appointment;
use App\Models\Treatment; 
use Illuminate\Database\Seeder;

class PrescriptionSeeder extends Seeder
{
    public function run(): void
    {
        $patientIds = Patient::pluck('id')->toArray();
        $doctorIds = Doctor::pluck('id')->toArray();
        $appointmentIds = Appointment::pluck('id')->toArray();
        $treatmentIds = Treatment::pluck('id')->toArray(); // Get all treatment IDs

        // Ensure that there are patients, doctors, appointments, and treatments
        if (empty($patientIds) || empty($doctorIds) || empty($appointmentIds) || empty($treatmentIds)) {
            $this->command->warn('Warning: Ensure patients, doctors, appointments, and treatments are seeded first.');
            return;
        }

        foreach (range(1, 30) as $index) {
            $prescription = Prescription::create([
                'patient_id' => $patientIds[array_rand($patientIds)],
                'doctor_id' => $doctorIds[array_rand($doctorIds)],
                'appointment_id' => $appointmentIds[array_rand($appointmentIds)],
                'notes' => fake()->paragraph(),
                'date_prescribed' => now()->subDays(rand(0, 30)),
            ]);

            // Attach random treatments with random quantities
            $numberOfTreatments = rand(1, 3);
            $randomTreatmentIds = array_rand(array_flip($treatmentIds), $numberOfTreatments);

            if (is_array($randomTreatmentIds)) {
                foreach ($randomTreatmentIds as $treatmentId) {
                    $quantity = rand(1, 5);
                    $prescription->treatments()->attach($treatmentId, ['quantity' => $quantity]);
                }
            } else {
                $quantity = rand(1, 5);
                $prescription->treatments()->attach($randomTreatmentIds, ['quantity' => $quantity]);
            }
        }

        $this->command->info('Prescription seeder ran successfully (with treatments).');
    }
}