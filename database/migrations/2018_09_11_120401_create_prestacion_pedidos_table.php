<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrestacionPedidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prestacion_pedidos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('trabajador_id')->nullable()->default(null);
            $table->integer('empresa_id')->nullable()->default(null);
            $table->integer('prestacion_tipo_id')->unsigned();
            $table->unsignedInteger('ausentismo_id')->nullable()->default(null);
            $table->text('descripcion')->nullable()->default(null);
            $table->text('observaciones')->nullable()->default(null);
            $table->text('presupuesto')->nullable()->default(null);
            $table->string('presupuesto_url')->nullable()->default(null);
            $table->string('confirmacion')->nullable()->default(null);
            $table->string('orden_servicio_url')->nullable()->default(null);
            $table->string('reporte')->nullable()->default(null);
            $table->string('reporte_url')->nullable()->default(null);
            $table->string('feedback')->nullable()->default(null);
            $table->boolean('estado')->default(true);
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
        Schema::dropIfExists('prestacion_pedidos');
    }
}
