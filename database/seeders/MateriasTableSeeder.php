<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Materia;
use App\Models\Carrera;

class MateriasTableSeeder extends Seeder
{
    public function run()
    {
        // Ensure there are some carreras first
        Carrera::factory()->count(5)->create();

        // Create materias
        Materia::factory()->count(25)->create();
    }
}
