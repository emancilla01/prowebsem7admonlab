<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\GrupoLab;

class GrupoLabForGroupsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $groups = [1,2,3,4];
        foreach ($groups as $g) {
            GrupoLab::factory()->create(['id_grupo' => $g]);
        }
    }
}
