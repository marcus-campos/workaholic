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
            'name' => 'Programação',
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString()
        ]);
        
        DB::table('job_categories')->insert([
            'id' => Str::orderedUuid(),
            'name' => 'Web Design',
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString()
        ]);

        DB::table('job_categories')->insert([
            'id' => Str::orderedUuid(),
            'name' => 'Lojas Virtuais (e-commerce)',
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString()
        ]);

        DB::table('job_categories')->insert([
            'id' => Str::orderedUuid(),
            'name' => 'Wordpress',
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString()
        ]);

        DB::table('job_categories')->insert([
            'id' => Str::orderedUuid(),
            'name' => 'Programação de Apps para Android, iOS e outros',
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString()
        ]);

        DB::table('job_categories')->insert([
            'id' => Str::orderedUuid(),
            'name' => 'Aplicativos desktop',
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString()
        ]);

        DB::table('job_categories')->insert([
            'id' => Str::orderedUuid(),
            'name' => 'UX/UI',
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString()
        ]);

        DB::table('job_categories')->insert([
            'id' => Str::orderedUuid(),
            'name' => 'Outros',
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString()
        ]);
    }
}
