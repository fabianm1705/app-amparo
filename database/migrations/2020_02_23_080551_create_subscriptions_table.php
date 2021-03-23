<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->boolean('grupal');
            $table->boolean('sepelio_estandar');
            $table->boolean('sepelio_plus');
            $table->boolean('salud');
            $table->boolean('odontologia');
            $table->boolean('orden_medica');
            $table->bigInteger('precio_grupo')->default(0);
            $table->bigInteger('precio_individual')->default(0);
            $table->bigInteger('precio_adherente')->default(0);
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
        Schema::dropIfExists('subscriptions');
    }
}
