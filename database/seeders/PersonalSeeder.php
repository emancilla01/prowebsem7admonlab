<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Personal;

class PersonalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create 10 sample Personal records
        Personal::factory()->count(10)->create();
    }
}
