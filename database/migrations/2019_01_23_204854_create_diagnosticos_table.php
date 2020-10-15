<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiagnosticosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diagnosticos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('diagnostico')->nullable();
            $table->string('guia')->nullable();
            $table->string('cuidados')->nullable();
            $table->string('tiempo')->nullable();
            $table->unsignedInteger('consulta_motivo_id')->nullable()->default(null);
            $table->foreign('consulta_motivo_id')->references('id')->on('consulta_motivos')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->unsignedInteger('user_id')->nullable()->default(null);
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');
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
        Schema::dropIfExists('diagnosticos');
    }
}
