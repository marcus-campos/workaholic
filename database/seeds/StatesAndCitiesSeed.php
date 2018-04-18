<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class StatesAndCitiesSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $path = public_path() . "/json/cities/estados-cidades.json";
        $json = json_decode(file_get_contents($path), true);

        foreach ($json['estados'] as $state) {
            $stateId = Str::orderedUuid();

            DB::table('states')->insert([
                'id' => $stateId,
                'name' => $state['nome'],
                'initials' => $state['sigla'],
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString()
            ]);

            foreach ($state['cidades'] as $city) {
                DB::table('cities')->insert([
                    'id' => Str::orderedUuid(),
                    'name' => $city,
                    'state_id' => $stateId,
                    'created_at' => Carbon::now()->toDateTimeString(),
                    'updated_at' => Carbon::now()->toDateTimeString()
                ]);
            }
        }
    }
}
