<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('categories_id');
            $table->unsignedBigInteger('authors_id');
            $table->string('titlename')->nullable();
            $table->string('image')->nullable();
            $table->date('date')->nullable();
            $table->string('bookname')->nullable();
            $table->string('publishername')->nullable();
            $table->string('edtion')->nullable();
            $table->string('produceyear')->nullable();
            $table->string('price')->nullable();
            $table->string('availablereason')->nullable();
            $table->string('remark')->nullable();
            $table->string('availablebook')->default(0);
            $table->string('totalbook')->default(0);
            $table->string('bookpdflink')->nullable();
            $table->string('slug');
            $table->dateTime('createdat')->nullable();
            $table->dateTime('updatedat')->nullable();
            $table->timestamps();
            $table->foreign('categories_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('authors_id')->references('id')->on('authors')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books');
    }
}
