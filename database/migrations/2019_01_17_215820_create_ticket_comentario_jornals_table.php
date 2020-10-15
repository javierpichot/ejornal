<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketComentarioJornalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ticket_comentario_jornals', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tickets_jornal_id')->unsigned();
            $table->integer('user_id');
            $table->longText('comentarios');
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
        Schema::dropIfExists('ticket_comentario_jornals');
    }
}
