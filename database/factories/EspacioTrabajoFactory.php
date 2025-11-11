<?php

namespace Database\Factories;

use App\Models\EspacioTrabajo;
use Illuminate\Database\Eloquent\Factories\Factory;

class EspacioTrabajoFactory extends Factory
{
    protected $model = EspacioTrabajo::class;

    public function definition()
    {
        return [
            'nombre_espacio' => $this->faker->words(3, true),
            'tipo_espacio' => $this->faker->randomElement(['Aula', 'Laboratorio', 'Oficina', 'Auditorio']),
            'ubicacion' => $this->faker->city(),
            'capacidad' => $this->faker->numberBetween(10, 200),
            'responsable' => $this->faker->name(),
        ];
    }
}
