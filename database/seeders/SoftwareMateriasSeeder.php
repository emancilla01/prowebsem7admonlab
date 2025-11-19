<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SoftwareMateria;

class SoftwareMateriasSeeder extends Seeder
{
    public function run(): void
    {
        // Create 30 sample relations
        SoftwareMateria::factory()->count(30)->create();
    }
}
