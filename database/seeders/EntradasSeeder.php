<?php

namespace Database\Seeders;

use App\Models\Entrada;
use Illuminate\Database\Seeder;

class EntradasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create sample entradas using the factory
        Entrada::factory()->count(10)->create();
    }
}
