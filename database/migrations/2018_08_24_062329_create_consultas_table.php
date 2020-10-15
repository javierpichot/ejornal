<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConsultasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consultas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('entrevista')->nullable()->default(null);
            $table->string('examen_fisico')->nullable()->default(null);
            $table->string('examenes_complementarios')->nullable()->default(null);
            $table->string('diagnostico')->nullable()->default(null);
            $table->string('plan')->nullable()->default(null);
            $table->string('tratamiento')->nullable()->default(null);
            $table->text('enfermeria')->nullable()->default(null);
            $table->date('fecha_consulta')->nullable()->default(null);
            $table->text('observacion')->nullable()->default(null);
            $table->date('nueva_cita')->nullable()->default(null);
            $table->unsignedInteger('trabajador_id')->nullable()->default(null);
            $table->foreign('trabajador_id')->references('id')->on('trabajadors')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->unsignedInteger('user_id')->nullable()->default(null);
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->integer('empresa_id')->unsigned()->index();
            $table->foreign('empresa_id')->references('id')->on('empresas')->onDelete('cascade');
            $table->integer('ausentismo_id')->unsigned()->nullable();
            $table->integer('documentacion_id')->unsigned()->nullable();
            $table->integer('consulta_reposo_id')->nullable()->unsigned();
            $table->integer('consulta_motivo_id')->nullable()->unsigned();
            $table->integer('diagnostico_id')->nullable()->unsigned();
            $table->unsignedInteger('consulta_tipo_id');
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
        Schema::dropIfExists('consultas');
    }
}
