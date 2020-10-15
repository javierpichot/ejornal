<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComunicacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comunicacions', function (Blueprint $table) {
            $table->increments('id');
            $table->date('fecha')->nullable()->default(null);
            $table->integer('motivo_comunicacion_id')->unsigned();
            $table->foreign('motivo_comunicacion_id')->references('id')->on('motivo_comunicacions')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->integer('remitente_id')->unsigned();
            $table->date('fecha_baja')->nullable();
            $table->text('observacion')->nullable();
            $table->text('contenido')->nullable()->default(null);
            $table->unsignedInteger('ausentismo_id')->nullable()->default(null);
            $table->foreign('ausentismo_id')->references('id')->on('ausentismos')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->unsignedInteger('user_id')->nullable()->default(null);
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->unsignedInteger('trabajador_id')->nullable()->default(null);
            $table->foreign('trabajador_id')->references('id')->on('trabajadors')->onUpdate('RESTRICT')->onDelete('RESTRICT');
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
        Schema::dropIfExists('comunicacions');
    }
}
