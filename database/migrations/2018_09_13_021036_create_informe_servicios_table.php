<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInformeServiciosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('informe_servicios', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('prestacion_pedido_id')->unsigned();
            $table->text('informe_servicio')->nullable()->default(null);
            $table->string('informe_servicio_url')->nullable()->default(null);
            $table->string('feedback')->nullable()->default(null);
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
        Schema::dropIfExists('informe_servicios');
    }
}
