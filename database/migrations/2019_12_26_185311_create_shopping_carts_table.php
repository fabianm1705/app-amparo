<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Carbon;

class CreateShoppingCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shopping_carts', function (Blueprint $table) {
            $table->id();
            $table->integer('status')->default(0);
            $table->string('email')->nullable();
            $table->date('fecha')->default(Carbon::now());
            $table->foreignId('user_id')->unsigned()->default(1)->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('payment_method_id')->unsigned()->default(1)->references('id')->on('payment_methods')->onDelete('cascade');
            $table->unsignedBigInteger('operation_id')->nullable();
            $table->string('estado')->default('pendiente');
            $table->date('fechaPago')->nullable();
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
        Schema::dropIfExists('shopping_carts');
    }
}
