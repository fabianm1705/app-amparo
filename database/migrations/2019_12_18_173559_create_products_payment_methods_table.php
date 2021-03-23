<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsPaymentMethodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products_payment_methods', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->unsigned()->references('id')->on('products')->onDelete('cascade');
            $table->foreignId('payment_methods_id')->unsigned()->references('id')->on('payment_methods')->onDelete('cascade');
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
        Schema::dropIfExists('products_payment_methods');
    }
}
