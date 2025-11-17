<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Grupo;
use App\Models\Materia;
use App\Models\Periodo;
use App\Models\Personal;
use App\Models\Carrera;

class GruposTableSeeder extends Seeder
{
    public function run()
    {
        // Ensure there are base records for relations
        if (Carrera::count() < 3) {
            Carrera::factory()->count(3)->create();
        }
        if (Materia::count() < 5) {
            Materia::factory()->count(5)->create();
        }
        if (Periodo::count() < 3) {
            Periodo::factory()->count(3)->create();
        }
        if (Personal::count() < 3) {
            Personal::factory()->count(3)->create();
        }

        // Create sample grupos
        Grupo::factory()->count(15)->create();
    }
}
