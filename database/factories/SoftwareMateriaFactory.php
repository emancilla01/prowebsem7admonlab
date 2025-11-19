<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\SoftwareMateria;
use App\Models\Software;
use App\Models\Materia;

class SoftwareMateriaFactory extends Factory
{
    protected $model = SoftwareMateria::class;

    public function definition()
    {
        return [
            'id_software' => Software::inRandomOrder()->value('id_software') ?? 1,
            'id_materia' => Materia::inRandomOrder()->value('id') ?? 1,
            'observaciones' => $this->faker->optional()->sentence(6),
        ];
    }
}
