<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgenteRiesgosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agente_riesgos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('codigo')->nullable();
            $table->string('agente_riesgo')->nullable();
            $table->string('criterio_exposicion')->nullable();
            $table->string('criterio_exposicion2')->nullable();
            $table->string('observaciones')->nullable();
            $table->string('limites')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('agente_riesgos');
    }
}
