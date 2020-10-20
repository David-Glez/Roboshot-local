<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RegistroLog extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // tabla para el registro de eventos generales en base de datos
        Schema::create('registroLog', function (Blueprint $table) {
           $table->bigIncrements('id');
           $table->date('fecha');
           $table->time('hora');
           $table->string('operacion');
           $table->string('disparador')->nullable()->default('-');
           $table->string('tabla')->nullable()->default('-');
           $table->string('esquema')->nullable()->default('-');
           $table->string('descripcion')->nullable()->default('-');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('registroLog');
    }
}
