<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Grupo;

class GrupoAlumnoFactory extends Factory
{
    protected $model = \App\Models\GrupoAlumno::class;

    public function definition()
    {
        $grupoId = Grupo::inRandomOrder()->value('id') ?? 1;

        return [
            'id_grupo' => $grupoId,
            'matricula' => $this->faker->unique()->bothify('2025####'),
            'nombre_alumno' => $this->faker->name(),
        ];
    }
}
