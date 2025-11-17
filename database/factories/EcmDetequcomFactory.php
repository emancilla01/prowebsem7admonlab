<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\EcmDetequcom;
use App\Models\EcmEqucommob;
use App\Models\EspacioTrabajo;

class EcmDetequcomFactory extends Factory
{
    protected $model = EcmDetequcom::class;

    public function definition()
    {
        return [
            'id_ecm' => EcmEqucommob::inRandomOrder()->value('id') ?? 1,
            'id_espacio' => EspacioTrabajo::inRandomOrder()->value('id_espacio') ?? null,
            'serial' => $this->faker->bothify('SN-#####'),
            'modelo' => $this->faker->word(),
            'marca' => $this->faker->company(),
            'descripcion' => $this->faker->sentence(6),
            'estado' => $this->faker->randomElement(['activo','baja','mtto']),
            'fecha_adquisicion' => $this->faker->date(),
            'ubicacion' => $this->faker->city(),
        ];
    }
}
