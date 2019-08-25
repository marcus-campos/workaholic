<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProposalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proposals', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->text('description');
            $table->double('net_value', 10, 2);
            $table->double('gross_value', 10, 2);
            $table->string('time_to_finish_the_job', 100)->nullable();
            $table->boolean('promoted')->default(false);
            $table->enum('status', ['done', 'accepted', 'rejected', 'waiting'])->default('waiting');
            $table->uuid('user_id');
            $table->uuid('job_id');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('job_id')->references('id')->on('jobs');
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
        Schema::dropIfExists('proposals');
    }
}
