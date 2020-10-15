<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfesionalFichadasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profesional_fichadas', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('profesional_id');
            $table->foreign('profesional_id')->references('id')->on('profesionals');
            $table->unsignedInteger('empresa_id');
            $table->foreign('empresa_id')->references('id')->on('empresas');

            $table->datetime('fechahora_entrada')->nullable()->default(null);
            $table->datetime('fechahora_salida')->nullable()->default(null);
            $table->string('IP_entrada')->nullable()->default(null);
            $table->string('IP_salida')->nullable()->default(null);
            $table->string('navegador_entrada')->nullable()->default(null);
            $table->string('navegador_salida')->nullable()->default(null);
            $table->string('localizacion_entrada')->nullable()->default(null);
            $table->string('localizacion_salida')->nullable()->default(null);
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
        Schema::dropIfExists('profesional_fichadas');
    }
}
