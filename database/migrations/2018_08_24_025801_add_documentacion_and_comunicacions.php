<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDocumentacionAndComunicacions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('comunicacions', function (Blueprint $table) {
            $table->integer('documentacion_id')->nullable()->unsigned();
            $table->integer('comunicacion_tipo_id')->nullable()->unsigned();
            $table->integer('modo_comunicacion_id')->nullable()->unsigned();
            $table->integer('empresa_id')->nullable()->unsigned();

        });
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
