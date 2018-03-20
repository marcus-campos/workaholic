<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class StatesAndCitiesSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $path = public_path() . "/storage/cities/estados-cidades.json";
        $json = json_decode(file_get_contents($path), true);

        foreach ($json['estados'] as $state) {
            DB::table('states')->insert([
                'name' => $state['nome'],
                'initials' => $state['sigla'],
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString()
            ]);

            $stateId = DB::getPdo()->lastInsertId();;

            foreach ($state['cidades'] as $city) {
                DB::table('cities')->insert([
                    'name' => $city,
                    'state_id' => $stateId,
                    'created_at' => Carbon::now()->toDateTimeString(),
                    'updated_at' => Carbon::now()->toDateTimeString()
                ]);
            }
        }
    }
}
