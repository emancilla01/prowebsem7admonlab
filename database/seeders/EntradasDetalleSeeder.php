<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EntradaDetalle;
use App\Models\Entrada;
use App\Models\EcmDetequcom;
use App\Models\EcmDetmob;
use App\Models\EspacioTrabajo;

class EntradasDetalleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $entradas = Entrada::pluck('id')->all();
        $ecmDetes = EcmDetequcom::pluck('id')->all();
        $ecmDetms = EcmDetmob::pluck('id')->all();
        $espacios = EspacioTrabajo::pluck('id_espacio')->all();
        if (empty($espacios)) {
            $espacios[] = EspacioTrabajo::factory()->create()->id_espacio;
        }

        if (empty($entradas)) {
            return; // no entradas to attach detalles to
        }

        foreach ($entradas as $entradaId) {
            // create 1-3 detalles per entrada
            $count = rand(1, 3);
            for ($i = 0; $i < $count; $i++) {
                EntradaDetalle::create([
                    'id_entrada' => $entradaId,
                    'id_ecm_dete' => $ecmDetes ? $ecmDetes[array_rand($ecmDetes)] : null,
                    'id_ecm_detm' => $ecmDetms ? $ecmDetms[array_rand($ecmDetms)] : null,
                    'no_serie' => 'SN-' . strtoupper(substr(md5(rand()), 0, 8)),
                    'id_espaciotrabajo' => $espacios ? $espacios[array_rand($espacios)] : null,
                ]);
            }
        }
    }
}
