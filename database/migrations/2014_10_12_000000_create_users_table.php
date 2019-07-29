<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('photo')->nullable();
            $table->string('biography', 1000)->nullable();
            $table->string('cpf', 11)->nullable();
            $table->string('cnpj', 14)->nullable();
            $table->string('phone')->nullable();
            $table->string('slack_user');
            $table->integer('score')->default(0);
            $table->enum('role', ['user', 'freelancer', 'company', 'admin'])->default('user');
            $table->rememberToken();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
