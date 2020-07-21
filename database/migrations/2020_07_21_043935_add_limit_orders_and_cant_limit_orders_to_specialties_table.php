<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLimitOrdersAndCantLimitOrdersToSpecialtiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('specialties', function (Blueprint $table) {
          $table->boolean('limitOrders')->default(0);
          $table->bigInteger('cantLimitOrders')->default(2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('specialties', function (Blueprint $table) {
            //
        });
    }
}
