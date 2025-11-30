<?php

namespace Database\Seeders;

use App\Models\Carrera;
use Illuminate\Database\Seeder;

class CarreraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Use make() + firstOrCreate to avoid unique-constraint failures when reseeding
        for ($i = 0; $i < 10; $i++) {
            $data = Carrera::factory()->make()->toArray();
            Carrera::firstOrCreate([
                'clave_carrera' => $data['clave_carrera'],
            ], $data);
        }
    }
}
