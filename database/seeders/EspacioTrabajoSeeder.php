<?php

namespace Database\Seeders;

use App\Models\EspacioTrabajo;
use Illuminate\Database\Seeder;

class EspacioTrabajoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        EspacioTrabajo::factory()->count(12)->create();
    }
}
