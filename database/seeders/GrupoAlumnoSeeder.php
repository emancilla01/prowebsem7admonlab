<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\GrupoAlumno;
use App\Models\Grupo;

class GrupoAlumnoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (Grupo::count() === 0) {
            $this->command->info('No hay grupos; se omite el seeder de GrupoAlumno.');
            return;
        }

        GrupoAlumno::factory()->count(50)->create();
    }
}
