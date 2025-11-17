<?php

namespace Database\Factories;

use App\Models\Carrera;
use Illuminate\Database\Eloquent\Factories\Factory;

class CarreraFactory extends Factory
{
    protected $model = Carrera::class;

    public function definition(): array
    {
        return [
            'nombre_carrera' => $this->faker->unique()->words(2, true),
            'clave_carrera' => strtoupper($this->faker->unique()->bothify('CRR-###')),
            'coordinador' => $this->faker->name(),
        ];
    }
}
