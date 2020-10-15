<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConsultaControlsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consulta_controls', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tension_arterial')->nullable()->default(null);
            $table->string('peso')->nullable()->default(null);
            $table->string('altura')->nullable()->default(null);
            $table->string('glucemia')->nullable()->default(null);
            $table->string('frecuencia_cardiaca')->nullable()->default(null);
            $table->string('saturacion_oxigeno')->nullable()->default(null);
            $table->integer('trabajador_id')->unsigned();
            $table->integer('consulta_id')->unsigned();
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
        Schema::dropIfExists('consulta_controls');
    }
}
