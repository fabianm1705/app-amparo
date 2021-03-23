<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentMethodItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_method_items', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->bigInteger('cuotas')->default(1);
            $table->bigInteger('percentage')->default(0);
            $table->bigInteger('activo')->default(1);
            $table->foreignId('payment_method_id')->unsigned()->references('id')->on('payment_methods')->onDelete('cascade');
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
        Schema::dropIfExists('payment_method_items');
    }
}
