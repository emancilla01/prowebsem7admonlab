<?php

namespace Database\Factories;

use App\Models\Materia;
use App\Models\Carrera;
use Illuminate\Database\Eloquent\Factories\Factory;

class MateriaFactory extends Factory
{
    protected $model = Materia::class;

    public function definition(): array
    {
        $carrera = Carrera::inRandomOrder()->first() ?? Carrera::factory()->create();

        return [
            'nombre' => $this->faker->sentence(3),
            'clave' => strtoupper($this->faker->unique()->bothify('MAT-###')),
            'id_carrera' => $carrera->id_carrera,
            'requiere_lab' => $this->faker->boolean(30),
            'tipo_uso' => $this->faker->randomElement([null, 'Práctica', 'Teórica']),
            'estatus' => $this->faker->randomElement(['activo','inactivo']),
        ];
    }
}
