<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookrentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookrents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('books_id');
            $table->unsignedBigInteger('stduents_id');
            $table->date('startdate')->nullable();
            $table->date('enddate')->nullable();
            $table->string('remark')->nullable();
            $table->string('numberofbook')->nullable();
            $table->foreign('books_id')->references('id')->on('books')->onDelete('cascade');
            $table->foreign('stduents_id')->references('id')->on('stduents')->onDelete('cascade');
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
        Schema::dropIfExists('bookrents');
    }
}
