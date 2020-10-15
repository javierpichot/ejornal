<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentacionEmpresaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documentacion_empresas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre')->nullable()->default(null);
            $table->string('descripcion')->nullable()->default(null);
            $table->string('url')->nullable()->default(null);
            $table->unsignedInteger('user_id')->nullable()->default(null);
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->unsignedInteger('empresa_id')->default(null);
            $table->foreign('empresa_id')->references('id')->on('empresas')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->unsignedInteger('documentacion_empresa_tipo_id');
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
        Schema::dropIfExists('documentacion_empresa');
    }
}
