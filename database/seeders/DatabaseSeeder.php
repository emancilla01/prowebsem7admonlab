<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

    // Seed Personal records
    $this->call(PersonalSeeder::class);

    // Seed Categorias
    $this->call(\Database\Seeders\CategoriaSeeder::class);

    // Seed Periodos
    $this->call(\Database\Seeders\PeriodoSeeder::class);

    // Seed Carreras
    $this->call(\Database\Seeders\CarreraSeeder::class);
    
    // Seed Espacios de trabajo
    $this->call(\Database\Seeders\EspacioTrabajoSeeder::class);

    // Seed Software
    $this->call(\Database\Seeders\SoftwareSeeder::class);
    }
}
