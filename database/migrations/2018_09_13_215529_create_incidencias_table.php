<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIncidenciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incidencias', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('consulta_id')->nullable()->default(null);
            $table->integer('trabajador_id')->nullable()->default(null);
            $table->dateTime('fecha');
            $table->integer('tipo_incidencia_id')->unsigned();
            $table->foreign('tipo_incidencia_id')->references('id')->on('tipo_incidencias');
            $table->string('sector')->nullable()->default(null);
            $table->string('tarea')->nullable()->default(null);
            $table->string('maquinaria_herramientas')->nullable()->default(null);
            $table->string('proteccion')->nullable()->default(null);
            $table->integer('tipo_lesion_id')->unsigned();
            $table->foreign('tipo_lesion_id')->references('id')->on('tipo_lesions');
            $table->integer('forma_accidente_id')->unsigned();
            $table->foreign('forma_accidente_id')->references('id')->on('forma_accidentes');
            $table->integer('ubicacion_lesion_id')->unsigned();
            $table->foreign('ubicacion_lesion_id')->references('id')->on('ubicacion_lesions');
            $table->text('descripcion')->nullable()->default(null);
            $table->text('testigos')->nullable()->default(null);
            $table->text('causas')->nullable()->default(null);
            $table->string('fotos_lesion')->nullable()->default(null);
            $table->string('fotos_accidente')->nullable()->default(null);
            $table->string('fotos_escenario')->nullable()->default(null);
            $table->text('examen_medico')->nullable()->default(null);
            $table->text('perimetria_medica')->nullable()->default(null);
            $table->text('declaracion_escrita')->nullable()->default(null);
            $table->integer('numero_art')->nullable()->default(null);
            $table->text('derivacion')->nullable()->default(null);
            $table->text('lugar')->nullable()->default(null);
            $table->text('declaracion_supervision')->nullable()->default(null);
            $table->text('declaracion_testigos')->nullable()->default(null);
            $table->text('acciones_inmediatas')->nullable()->default(null);
            $table->text('acciones_correctivas')->nullable()->default(null);
            $table->integer('empresa_id')->nullable()->default(null);
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('incidencias');
    }
}
