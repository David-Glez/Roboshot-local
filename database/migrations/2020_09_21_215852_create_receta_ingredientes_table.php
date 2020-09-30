<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecetaIngredientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recetaIngrediente', function (Blueprint $table) {
            $table->bigIncrements('id')->unique();
            $table->integer('idReceta');
            $table->integer('idIngrediente');
            $table->integer('cantidad');
            $table->foreign('idReceta')->references('idReceta')->on('recetas');
            $table->foreign('idIngrediente')->references('idIngrediente')->on('ingredientes');
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
        Schema::dropIfExists('recetaIngredientes');
    }
}
