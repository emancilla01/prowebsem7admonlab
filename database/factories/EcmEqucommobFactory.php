<?php

namespace Database\Factories;

use App\Models\EcmEqucommob;
use App\Models\Categoria;
use Illuminate\Database\Eloquent\Factories\Factory;

class EcmEqucommobFactory extends Factory
{
    protected $model = EcmEqucommob::class;

    public function definition()
    {
        $tipos = ['equipo', 'mobiliario'];
        $estados = ['activo', 'baja', 'mtto'];

        // Try to pick an existing categoria id; fall back to 1 if none.
        $categoriaId = Categoria::inRandomOrder()->value('id') ?? 1;

        return [
            'codigo' => $this->faker->unique()->bothify('ECM-####'),
            'descripcion' => $this->faker->sentence(6),
            'id_categoria' => $categoriaId,
            'tipo' => $this->faker->randomElement($tipos),
            'estado' => $this->faker->randomElement($estados),
            'fecha_alta' => $this->faker->optional(0.8)->date(),
        ];
    }
}
