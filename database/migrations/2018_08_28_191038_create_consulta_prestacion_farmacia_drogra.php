<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConsultaPrestacionFarmaciaDrogra extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consulta_prestacion_farmacia_droga', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('consulta_id');
            $table->unsignedInteger('trabajador_id');
            $table->unsignedInteger('prestacion_farmacia_droga_id');
            $table->string('cantidad')->nullable()->default(null);
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
        Schema::dropIfExists('consulta_prestacion_farmacia_droga');
    }
}
