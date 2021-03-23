<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductInShoppingCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_in_shopping_carts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->unsigned()->references('id')->on('products')->onDelete('cascade');
            $table->foreignId('shopping_cart_id')->unsigned()->references('id')->on('shopping_carts');
            $table->bigInteger('cantidadUnidades')->default(1);
            $table->bigInteger('cantidadCuotas')->nullable();
            $table->bigInteger('costo')->nullable();
            $table->bigInteger('total')->nullable();
            $table->bigInteger('percentage')->default(0);
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
        Schema::dropIfExists('product_in_shopping_carts');
    }
}
