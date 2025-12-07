<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\EntradaDetalle;
use App\Models\Entrada;
use App\Models\EcmDetequcom;
use App\Models\EcmDetmob;
use App\Models\EspacioTrabajo;

class EntradaDetalleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = EntradaDetalle::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $entradaId = Entrada::inRandomOrder()->value('id');
        $ecmDeteId = EcmDetequcom::inRandomOrder()->value('id');
        $ecmDetmId = EcmDetmob::inRandomOrder()->value('id');

        return [
            'id_entrada' => $entradaId ? $entradaId : Entrada::factory(),
            'id_ecm_dete' => $ecmDeteId ?: null,
            'id_ecm_detm' => $ecmDetmId ?: null,
            'no_serie' => $this->faker->bothify('SN-????-#####'),
            'id_espaciotrabajo' => EspacioTrabajo::inRandomOrder()->value('id_espacio') ?: EspacioTrabajo::factory(),
        ];
    }
}
