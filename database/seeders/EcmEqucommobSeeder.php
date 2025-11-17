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
        EcmEqucommob::factory()->count(20)->create();
    }
}
