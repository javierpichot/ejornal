<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRevisionPeriodicasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('revision_periodicas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('informe')->nullable()->default(null);
            $table->string('completado')->nullable()->default(null);
            $table->string('observaciones')->nullable()->default(null);
            $table->string('fotos')->nullable()->default(null);
            $table->date('nuevo_control');
            $table->unsignedInteger('user_id')->nullable()->default(null);
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->integer('revision_periodica_entidad_id')->unsigned()->index();
            $table->integer('revision_periodica_tipo_id')->unsigned()->index();
            $table->foreign('revision_periodica_tipo_id')->references('id')->on('revision_periodica_tipos')->onDelete('cascade');
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
        Schema::dropIfExists('revision_periodicas');
    }
}
