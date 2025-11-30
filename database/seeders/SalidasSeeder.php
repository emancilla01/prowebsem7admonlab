<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Salida;

class SalidasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // create 10 sample salidas
        Salida::factory()->count(10)->create();
    }
}
