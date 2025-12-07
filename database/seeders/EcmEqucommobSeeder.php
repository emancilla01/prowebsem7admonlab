<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EcmEqucommob;

class EcmEqucommobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create 20 sample ECM records. Assumes categorias are already seeded.
        for ($i = 0; $i < 20; $i++) {
            $data = EcmEqucommob::factory()->make()->toArray();
            EcmEqucommob::firstOrCreate([
                'codigo' => $data['codigo'],
            ], $data);
        }
    }
}
