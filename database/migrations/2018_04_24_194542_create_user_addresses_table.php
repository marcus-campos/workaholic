<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_addresses', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('address'); //Street | Avenue
            $table->integer('number');
            $table->string('complement')->nullable();
            $table->string('neighborhood');
            $table->string('zip_code', 10); //Limitei a 10 caracteres pois existem rumores que o CEP pode mudar o seu formato em alguns anos
            $table->uuid('city_id');
            $table->uuid('user_id');
            $table->boolean('primary')->default(false);
            $table->timestamps();
            $table->softDeletes();

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
        Schema::dropIfExists('user_addresses');
    }
}
