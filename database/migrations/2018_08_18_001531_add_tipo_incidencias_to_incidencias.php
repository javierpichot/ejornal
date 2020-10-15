<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTipoIncidenciasToIncidencias extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*Schema::table('incidencias', function (Blueprint $table) {
            $table->integer('tipo_incidencia_id')->nullable()->unsigned();
            $table->foreign('tipo_incidencia_id')->references('id')->on('tipo_incidencias')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });*/
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
