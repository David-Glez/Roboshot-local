<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBebidasVendidasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bebidasVendidas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('idVenta');
            $table->enum('tipo', ['receta', 'personalizada']);
            $table->string('nombre', 255)->nullable();
            $table->integer('cantidad');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bebidasVendidas');
    }
}
