<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class JobCategoriesSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('job_categories')->insert([
            'id' => Str::orderedUuid(),
            'name' => 'Assistência Técnica',
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString()
        ]);

        DB::table('job_categories')->insert([
            'id' => Str::orderedUuid(),
            'name' => 'Aulas',
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString()
        ]);

        DB::table('job_categories')->insert([
            'id' => Str::orderedUuid(),
            'name' => 'Autos',
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString()
        ]);

        DB::table('job_categories')->insert([
            'id' => Str::orderedUuid(),
            'name' => 'Design e Tecnologia',
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString()
        ]);

        DB::table('job_categories')->insert([
            'id' => Str::orderedUuid(),
            'name' => 'Eventos',
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString()
        ]);

        DB::table('job_categories')->insert([
            'id' => Str::orderedUuid(),
            'name' => 'Moda e beleza',
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString()
        ]);

        DB::table('job_categories')->insert([
            'id' => Str::orderedUuid(),
            'name' => 'Reformas',
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString()
        ]);

        DB::table('job_categories')->insert([
            'id' => Str::orderedUuid(),
            'name' => 'Saúde',
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString()
        ]);

        DB::table('job_categories')->insert([
            'id' => Str::orderedUuid(),
            'name' => 'Serviços domésticos',
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString()
        ]);
    }
}
