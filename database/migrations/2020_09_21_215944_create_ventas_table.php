<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*Schema::create('ventas', function (Blueprint $table) {
            $table->bigIncrements('idVenta')->unique();
            $table->integer('idReceta');
            $table->float('precio');
            $table->date('fecha');
            $table->time('hora');
            $table->foreign('idReceta')->references('idReceta')->on('recetas');
            $table->timestamps();
        });*/

        Schema::create('ventas', function (Blueprint $table) {
            $table->id();
            $table->float('total');
            $table->float('ganancia');
            $table->boolean('online');
            $table->timestampTz('fecha', 0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ventas');
    }
}
