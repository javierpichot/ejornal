<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documentacions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('url')->nullable()->default(null);
            $table->date('fecha_documento');
            $table->date('fecha_entrega');
            $table->date('fecha_incorporacion')->nullable()->default(null);
            $table->text('observacion')->nullable()->default(null);
            $table->string('diagnostico')->nullable()->default(null);
            $table->string('institucion')->nullable()->default(null);
            $table->string('medico')->nullable()->default(null);
            $table->boolean('notifico')->default(false);
            $table->integer('reposo')->nullable()->default(null);
            $table->date('fecha_baja')->nullable()->default(null);
            $table->string('matricula_nacional')->nullable()->default(null);
            $table->string('matricula_provincial')->nullable()->default(null);
            $table->unsignedInteger('trabajador_id')->nullable()->default(null);
            $table->unsignedInteger('empresa_id')->nullable()->default(null);
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('ausentismo_id')->nullable()->default(null);
            $table->unsignedInteger('consulta_id')->nullable()->default(null);
            $table->unsignedInteger('comunicacion_id')->nullable()->default(null);
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
        Schema::dropIfExists('documentacions');
    }
}
