<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eventos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->enum('tipo', ['INFO', 'OK', 'WARN', 'DANGER', 'DEFAULT'])->default('DEFAULT');
            //$table->smallInteger('evento');
            $table->smallInteger('origen');
            $table->smallInteger('codigo');
            $table->json('info')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('eventos');
    }
}
