<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIngredientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ingredientes', function (Blueprint $table) {
            $table->bigIncrements('idIngrediente')->unique();
            $table->integer('idCategoria');
            $table->string('marca')->nullable();
            $table->float('precio', 4,2);
            $table->integer('cantidadTotal'); //cantidad neta de la botella
            //$table->integer('cantidadDisponible'); //cantidad disponible de la botella
            //$table->integer('posicion');
            $table->float('precioCompra', 4,2);
            $table->float('precioVenta', 4,2);
            $table->foreign('idCategoria')->references('idCategoria')->on('categorias');
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
        Schema::dropIfExists('ingredientes');
    }
}
