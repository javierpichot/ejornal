<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRevisionPeriodicaEntidadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('revision_periodica_entidads', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('empresa_id')->unsigned()->index();
            $table->foreign('empresa_id')->references('id')->on('empresas')->onDelete('cascade');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('tipo_tarea_id');
            $table->string('nombre')->nullable()->default(null);
            $table->integer('frecuencia')->nullable()->default(null);
            $table->integer('role_id')->nullable()->default(null);
            $table->string('foto')->nullable()->default(null);
            $table->string('descripcion')->nullable()->default(null);
            $table->string('observaciones')->nullable()->default(null);
            $table->boolean('estado')->default(0);
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
        Schema::dropIfExists('revision_periodica_entidads');
    }
}
