<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrabajadorFamiliarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trabajador_familiars', function (Blueprint $table) {
            $table->integer('trabajador_id')->unsigned();
            $table->foreign('trabajador_id')->references('id')->on('trabajadors');
            $table->string('nombre_familiar')->nullable()->default(null);
            $table->string('celular_familiar')->nullable()->default(null);
            $table->integer('carga_familiar')->nullable()->default(null);
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
        Schema::dropIfExists('trabajador_familiar');
    }
}
