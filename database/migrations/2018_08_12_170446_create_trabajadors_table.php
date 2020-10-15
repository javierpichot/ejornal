<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrabajadorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trabajadors', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->string('apellido');
            $table->date('fecha_nacimiento')->nullable()->default(null);
            $table->string('documento')->nullable()->default(null);
            $table->integer('numero_afiliado')->nullable()->default(null);
            $table->string('celular')->nullable()->default(null);
            $table->string('telefono')->nullable()->default(null);
            $table->text('direccion')->nullable()->default(null);
            $table->string('localidad')->nullable()->default(null);
            $table->string('email')->nullable()->default(null);
            $table->string('photo')->nullable()->default(null);
            $table->integer('numero_legajo')->nullable()->default(null);
            $table->text('observacion_direccion')->nullable()->default(null);
            $table->date('fecha_contrato')->nullable()->default(null);
            $table->integer('sector_id')->unsigned()->nullable()->default(null);
            $table->integer('turno_id')->unsigned()->nullable()->default(null);
            $table->integer('tarea_id')->unsigned()->nullable()->default(null);
            $table->integer('empresa_id')->unsigned()->nullable()->default(null);
            $table->foreign('empresa_id')->references('id')->on('empresas');
            $table->integer('obra_social_id')->unsigned()->unsigned()->nullable()->default(null);
            $table->foreign('obra_social_id')->references('id')->on('obra_socials');
            $table->integer('localidad_id')->unsigned()->unsigned()->nullable()->default(null);
            $table->foreign('localidad_id')->references('id')->on('localidads');
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
        Schema::dropIfExists('trabajadors');
    }
}
