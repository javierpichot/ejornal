<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrestacionStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prestacion_stocks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('prestacion_farmacia_droga_id')->unsigned();
            $table->integer('cantidad');
            $table->date('caducidad');
            $table->integer('empresa_id')->unsigned();
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
        Schema::dropIfExists('prestacion_stocks');
    }
}
