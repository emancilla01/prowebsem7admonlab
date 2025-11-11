<?php

namespace Database\Factories;

use App\Models\Software;
use App\Models\EspacioTrabajo;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Software>
 */
class SoftwareFactory extends Factory
{
    protected $model = Software::class;

    public function definition()
    {
        // try to pick an existing espacio id, otherwise null
        $espacio = EspacioTrabajo::inRandomOrder()->first();

        return [
            'nombre_software' => $this->faker->word() . ' ' . $this->faker->bothify('##'),
            'version' => $this->faker->numerify('v#.##'),
            'licencia' => $this->faker->optional()->bothify('LIC-####'),
            'proveedor' => $this->faker->company(),
            'fecha_instalacion' => $this->faker->optional()->date(),
            'id_espacio' => $espacio? $espacio->id_espacio : null,
        ];
    }
}
