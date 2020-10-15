<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrestacionCotizacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prestacion_cotizacions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('prestacion_pedido_id')->unsigned();
            $table->integer('prestacion_tipo_id')->unsigned();
            $table->integer('proveedor_id')->unsigned();
            $table->text('cotizacion')->nullable()->default(null);
            $table->string('cotizacion_url')->nullable()->default(null);
            $table->text('observaciones')->nullable()->default(null);
            $table->string('aprobado')->nullable()->default(null);
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
        Schema::dropIfExists('prestacion_cotizacions');
    }
}
