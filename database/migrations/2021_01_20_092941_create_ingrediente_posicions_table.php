<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIngredientePosicionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ingredientePosicion', function (Blueprint $table) {
            $table->integer('posicion')->primary();
            $table->integer('idIngrediente');
            $table->decimal('cantidad', 8, 2);
            $table->integer('cantidadTotal'); //cantidad neta de la botella
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
        Schema::dropIfExists('ingredientePosicion');
    }
}
