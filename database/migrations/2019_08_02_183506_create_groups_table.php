<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('groups', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nroSocio');
            $table->date('fechaAlta');
            $table->string('email')->nullable();
            $table->string('telefono')->nullable();
            $table->string('direccion');
            $table->string('direccionCobro');
            $table->string('diaCobro')->nullable();
            $table->string('horaCobro')->nullable();
            $table->bigInteger('total');
            $table->boolean('activo');
            $table->timestamps();
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_spanish_ci';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('groups');
    }
}
