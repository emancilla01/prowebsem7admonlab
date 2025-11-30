<?php

namespace Database\Factories;

use App\Models\Salida;
use Illuminate\Database\Eloquent\Factories\Factory;

class SalidaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Salida::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'fecha' => $this->faker->date(),
            'hora' => $this->faker->time('H:i:s'),
            'quien_autorizo' => $this->faker->name(),
            'quien_registro' => $this->faker->name(),
        ];
    }
}
