<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProveedorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proveedors', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->text('descripcion')->nullable()->default(null);
            $table->integer('prestacion_tipo_id')->unsigned();
            $table->foreign('prestacion_tipo_id')->references('id')->on('prestacion_tipos')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->string('email')->nullable()->default(null);
            $table->string('telefono')->nullable()->default(null);
            $table->text('direccion')->nullable()->default(null);
            $table->string('zona')->nullable()->default(null);
            $table->text('observaciones')->nullable()->default(null);
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
        Schema::dropIfExists('proveedors');
    }
}
