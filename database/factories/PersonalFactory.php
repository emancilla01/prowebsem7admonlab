<?php

namespace Database\Factories;

use App\Models\Personal;
use Illuminate\Database\Eloquent\Factories\Factory;

class PersonalFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Personal::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'rfc' => strtoupper($this->faker->bothify('????######??')),
            'nombre' => $this->faker->firstName(),
            'apellido_pat' => $this->faker->lastName(),
            'apellido_mat' => $this->faker->lastName(),
            'email' => $this->faker->unique()->safeEmail(),
            'sexo' => $this->faker->randomElement(Personal::SEXO_VALUES),
            'depto' => $this->faker->randomElement(['Ventas', 'Soporte', 'Ingeniería', 'RRHH', 'Administración']),
        ];
    }
}
