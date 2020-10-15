<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAntecedenteFamilarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('antecedente_familars', function (Blueprint $table) {
            $table->integer('trabajador_id')->unsigned();
            $table->foreign('trabajador_id')->references('id')->on('trabajadors');
            $table->integer('enfermedad_id')->unsigned();
            $table->foreign('enfermedad_id')->references('id')->on('enfermedads');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('antecedente_familars');
    }
}
