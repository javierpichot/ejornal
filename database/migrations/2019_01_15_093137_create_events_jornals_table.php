<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsJornalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events_jornals', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->mediumText('description');
            $table->date('start_date');
            $table->date('end_date');
            $table->time('start_time')->nullable()->default(null);
            $table->time('end_time')->nullable()->default(null);
            $table->integer('user_id');
            $table->string('location')->nullable()->default(null);
            $table->text('labels')->nullable()->default(null);
            $table->mediumText('share_with')->nullable()->default(null);
            $table->string('color');
            $table->integer('recurring')->nullable()->default(0);
            $table->integer('repeat_every')->nullable()->default(0);
            $table->enum('repeat_type', ['days', 'weeks', 'months', 'years'])->nullable()->default(null);
            $table->integer('no_of_cycles')->nullable()->default(0);
            $table->date('last_start_date')->nullable()->default(null);
            $table->longText('recurring_dates')->nullable()->default(null);
            $table->text('confirmed_by');
            $table->text('rejected_by');
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
        Schema::dropIfExists('events_jornals');
    }
}
