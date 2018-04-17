<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('title', 120);
            $table->text('description', 10000);
            $table->string('neighborhood', 120)->nullable();
            $table->uuid('city_id')->nullable();
            $table->boolean('remote');
            $table->time('initial_time')->nullable();
            $table->time('final_time')->nullable();
            $table->date('specific_date')->nullable();
            $table->uuid('job_category_id');
            $table->uuid('user_id');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('job_category_id')->references('id')->on('job_categories');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jobs');
    }
}
