<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\EcmDetmob;
use App\Models\EcmEqucommob;

class EcmDetmobFactory extends Factory
{
    protected $model = EcmDetmob::class;

    public function definition()
    {
        return [
            'id_ecm' => EcmEqucommob::inRandomOrder()->value('id') ?? 1,
            'codigo' => $this->faker->bothify('MOB-#####'),
            'descripcion' => $this->faker->sentence(6),
            'material' => $this->faker->randomElement(['Madera','Metal','Plástico','Vidrio']),
            'estado' => $this->faker->randomElement(['activo','baja','mtto']),
            'fecha_adquisicion' => $this->faker->date(),
            'ubicacion' => $this->faker->city(),
        ];
    }
}
