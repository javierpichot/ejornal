<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgenteRiesgoTareasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agente_riesgo_tarea', function (Blueprint $table) {
            $table->integer('tarea_id')->unsigned();
            $table->foreign('tarea_id')->references('id')->on('tareas');
            $table->integer('agente_riesgo_id')->unsigned();
            $table->foreign('agente_riesgo_id')->references('id')->on('agente_riesgos');
        });
        

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('agente_riesgo_tarea');
    }
}
