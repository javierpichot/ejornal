<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentacionClinicasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documentacion_clinicas', function (Blueprint $table) {
          $table->increments('id');
          $table->string('titulo')->nullable()->default(null);
          $table->string('descripcion')->nullable()->default(null);
          $table->string('url')->nullable()->default(null);
          $table->unsignedInteger('documentacion_clinica_tipo_id')->nullable()->default(null);
          $table->foreign('documentacion_clinica_tipo_id')->references('id')->on('documentacion_clinica_tipos')->onUpdate('RESTRICT')->onDelete('RESTRICT');
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
        Schema::dropIfExists('documentacion_clinicas');
    }
}
