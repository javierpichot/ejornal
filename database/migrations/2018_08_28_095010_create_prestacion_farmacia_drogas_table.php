<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrestacionFarmaciaDrogasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prestacion_farmacia_drogas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->string('via_prestacion');
            $table->integer('empresa_id')->unsigned();
            $table->integer('cantidad');
            $table->date('fecha_caducidad')->nullable()->default(null);
            $table->integer('prestacion_droga_tipo_id')->unsigned();
            $table->foreign('prestacion_droga_tipo_id')->references('id')->on('prestacion_droga_tipos')->onUpdate('RESTRICT')->onDelete('RESTRICT');
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
        Schema::dropIfExists('prestacion_farmacia_drogas');
    }
}
