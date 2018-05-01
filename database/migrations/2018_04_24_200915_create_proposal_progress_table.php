<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProposalProgressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proposal_progress', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->integer('percentage')->default(0);
            $table->enum('status', ['accepted', 'rejected', 'waiting'])->default('waiting');
            $table->uuid('proposal_id');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('proposal_id')->references('id')->on('proposals');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('proposal_progress');
    }
}
