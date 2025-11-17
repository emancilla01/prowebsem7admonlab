<?php

namespace Database\Factories;

use App\Models\Grupo;
use App\Models\Materia;
use App\Models\Periodo;
use App\Models\Personal;
use App\Models\Carrera;
use Illuminate\Database\Eloquent\Factories\Factory;

class GrupoFactory extends Factory
{
    protected $model = Grupo::class;

    public function definition(): array
    {
        $materia = Materia::inRandomOrder()->first() ?? Materia::factory()->create();
        $periodo = Periodo::inRandomOrder()->first() ?? Periodo::factory()->create();
        $personal = Personal::inRandomOrder()->first() ?? Personal::factory()->create();
        $carrera = Carrera::inRandomOrder()->first() ?? Carrera::factory()->create();

        return [
            'nombre_grupo' => $this->faker->words(2, true),
            'clave_grupo' => strtoupper($this->faker->unique()->bothify('GRP-###')),
            'id_materia' => $materia->id,
            'id_periodo' => $periodo->id,
            'id_personal' => $personal->id,
            'id_carrera' => $carrera->id_carrera,
            'turno' => $this->faker->randomElement(['matutino','vespertino','nocturno']),
            'estatus' => $this->faker->randomElement(['activo','cerrado']),
        ];
    }
}
