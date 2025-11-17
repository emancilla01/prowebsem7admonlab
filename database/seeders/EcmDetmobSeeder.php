<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EcmDetmob;
use App\Models\EcmEqucommob;
use Illuminate\Support\Arr;

class EcmDetmobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ecmIds = EcmEqucommob::pluck('id')->toArray();
        if (empty($ecmIds)) {
            $this->command->info('No ECM records found; skipping EcmDetmobSeeder.');
            return;
        }

        foreach (range(1, 30) as $i) {
            EcmDetmob::factory()->create([
                'id_ecm' => Arr::random($ecmIds),
            ]);
        }

        $this->command->info('EcmDetmobSeeder: created 30 mobiliario records.');
    }
}
