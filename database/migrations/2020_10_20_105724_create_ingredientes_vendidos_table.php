<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIngredientesVendidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ingredientesVendidos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('idVenta');
            $table->foreignId('idIngrediente');
            $table->float('cantidad', 4,2);
            $table->float('precioCompra', 4,2);
            $table->float('precioVenta', 4,2);
            $table->string('nombre')->nullable();
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
        Schema::dropIfExists('ingredientesVendidos');
    }
}
