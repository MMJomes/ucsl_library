<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('event_categories_id');
            $table->string('name');
            $table->string('description');
            $table->string('location');
            $table->string('map');
            $table->dateTime('from_date');
            $table->dateTime('to_date');
            $table->string('from_time');
            $table->string('to_time');
            $table->enum('sort', [ON, OFF])->default(OFF);
            $table->enum('status', [ON, OFF])->default(OFF);
            $table->dateTime('createdate')->nullable();
            $table->dateTime('updatedate')->nullable();
            $table->string('slug');
            $table->timestamps();
            $table->foreign('event_categories_id')->references('id')->on('event_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
}
