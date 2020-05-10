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
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->nullable();
            $table->timestamp('email_verified_at')->default(now());
            $table->string('password');
            $table->timestamp('password_changed_at')->nullable();
            $table->string('nroAdh')->nullable();
            $table->bigInteger('tipoDoc')->nullable();
            $table->bigInteger('nroDoc');
            $table->string('sexo')->nullable();
            $table->date('fechaNac')->nullable();
            $table->boolean('activo')->default(1);
            $table->boolean('vigenteOrden')->default(1);
            $table->rememberToken();
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
