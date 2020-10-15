<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfesionalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profesionals', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->string('apellido');
            $table->string('email')->nullable()->default(null);
            $table->string('celular')->nullable()->default(null);
            $table->string('nombre_familiar')->nullable()->default(null);
            $table->string('celular_familiar')->nullable()->default(null);
            $table->text('direccion')->nullable()->default(null);
            $table->integer('localidad_id')->unsigned()->nullable()->default(null);
            $table->foreign('localidad_id')->references('id')->on('localidads');
            $table->text('observacion_direccion')->nullable()->default(null);
            $table->integer('numero_obra_social')->unsigned()->unsigned()->nullable()->default(null);
            $table->integer('obra_social_id')->unsigned()->nullable()->default(null);
            $table->foreign('obra_social_id')->references('id')->on('obra_socials');
            $table->text('observacion_facturacion')->nullable()->default(null);
            $table->text('observacion_supervision')->nullable()->default(null);
            $table->string('photo')->nullable()->default(null);
            $table->integer('user_id')->unsigned()->nullable()->default(null);
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('profesional_tipo_id')->unsigned()->nullable()->default(null);
            $table->foreign('profesional_tipo_id')->references('id')->on('profesional_tipos');
            $table->string('foto_titulo')->nullable()->default(null);
            $table->string('documento');
            $table->string('foto_documento')->nullable()->default(null);
            $table->integer('poliza')->nullable()->default(null);
            $table->string('foto_seguro')->nullable()->default(null);
            $table->integer('numero_matricula')->nullable()->default(null);
            $table->string('foto_matricula')->nullable()->default(null);
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
        Schema::dropIfExists('profesionals');
    }
}
