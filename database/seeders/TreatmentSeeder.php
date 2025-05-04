<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Treatment;
use Illuminate\Database\Seeder;

class TreatmentSeeder extends Seeder
{
    public function run(): void
    {
        $treatments = [
            ['name' => 'Paracetamol', 'dosage' => '500mg'],
            ['name' => 'Amoxicillin', 'dosage' => '250mg'],
            ['name' => 'Cough Syrup', 'dosage' => '10ml'],
            ['name' => 'Vitamin C', 'dosage' => '500mg'],
            ['name' => 'Ibuprofen', 'dosage' => '200mg'],
            ['name' => 'Antihistamine', 'dosage' => '10mg'],
            ['name' => 'Loperamide', 'dosage' => '2mg'],
            ['name' => 'Hydrocortisone Cream', 'dosage' => '1%'],
            ['name' => 'Antacid', 'dosage' => '10mg'],
            ['name' => 'Multivitamins', 'dosage' => '1 tablet'],
        ];

        foreach ($treatments as $treatment) {
            Treatment::create($treatment);
        }

        $this->command->info('Treatment seeder ran successfully.');
    }
}