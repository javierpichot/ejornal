<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAusentismosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ausentismos', function (Blueprint $table) {
            $table->increments('id');
            $table->date('fecha_ausente')->nullable()->default(null);
            $table->integer('empresa_id')->unsigned();
            $table->integer('trabajador_id')->unsigned();
            $table->integer('ausentismo_tipo_id')->unsigned();
            $table->integer('consulta_motivo_id')->unsigned();
            $table->integer('incidencia_id')->nullable()->default(null);
            $table->date('fecha_alta')->nullable()->default(null);
            $table->date('fecha_probable_alta')->nullable()->default(null);
            $table->text('motivo')->nullable()->default(null);
            $table->text('observacion')->nullable()->default(null);
            $table->integer('user_id')->unsigned();
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
        Schema::dropIfExists('ausentismos');
    }
}
