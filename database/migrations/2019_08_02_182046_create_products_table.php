<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('modelo');
            $table->text('descripcion')->nullable();
            $table->string('image_url')->nullable();
            $table->string('image_url2')->nullable();
            $table->string('image_url3')->nullable();
            $table->bigInteger('costo')->default(0);
            $table->bigInteger('montoCuota')->default(0);
            $table->bigInteger('cantidadCuotas');
            $table->string('empresa')->nullable();
            $table->text('longDescription')->nullable();
            $table->boolean('vigente');
            $table->bigInteger('stock')->default(0);
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
        Schema::dropIfExists('products');
    }
}
