<?php

namespace Database\Factories;

use App\Models\GrupoLab;
use App\Models\Grupo;
use App\Models\EspacioTrabajo;
use Illuminate\Database\Eloquent\Factories\Factory;

class GrupoLabFactory extends Factory
{
    protected $model = GrupoLab::class;

    public function definition(): array
    {
        $grupo = Grupo::inRandomOrder()->first() ?? Grupo::factory()->create();
        $espacio = EspacioTrabajo::inRandomOrder()->first() ?? EspacioTrabajo::factory()->create();

        return [
            'id_grupo' => $grupo->id,
            'id_espacio' => $espacio->id_espacio,
            'horario' => $this->faker->randomElement([
                'Lun-Mie 8:00-9:30',
                'Mar-Jue 10:00-11:30',
                'Vie 14:00-17:00',
                'Lun-Vie 9:00-10:00'
            ]),
        ];
    }
}
