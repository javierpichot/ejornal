<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrestacionPresupuestosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prestacion_presupuestos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('prestacion_pedido_id')->unsigned();
            $table->integer('prestacion_tipo_id')->unsigned();
            $table->integer('proveedor_id')->unsigned();
            $table->text('presupuesto')->nullable()->default(null);
            $table->string('presupuesto_url')->nullable()->default(null);
            $table->text('observaciones')->nullable()->default(null);
            $table->boolean('aprobado')->default(false);
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
        Schema::dropIfExists('prestacion_presupuestos');
    }
}
