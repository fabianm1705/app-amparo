<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPacientIdAndDoctorIdToOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
          $table->foreignId('pacient_id')->unsigned()->nullable()->references('id')->on('users')->onDelete('cascade');
          $table->foreignId('doctor_id')->unsigned()->nullable()->references('id')->on('doctors')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
          $table->dropForeign(['pacient_id']);
          $table->dropForeign(['doctor_id']);
        });
    }
}
