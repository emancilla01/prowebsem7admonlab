<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\GrupoLab;

class GrupoLabSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        GrupoLab::factory(10)->create();
    }
}
