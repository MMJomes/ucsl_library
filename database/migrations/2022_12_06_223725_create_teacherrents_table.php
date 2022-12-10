<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeacherrentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teacherrents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('books_id');
            $table->unsignedBigInteger('teachers_id');
            $table->date('startdate')->nullable();
            $table->date('enddate')->nullable();
            $table->string('remark')->nullable();
            $table->string('status')->nullable();
            $table->string('numberofbook')->nullable();
            $table->enum('rentstatus', [ON, OFF])->default(OFF);
            $table->enum('requesttatus', [ON, OFF])->default(OFF);
            $table->enum('approvetatus', [ON, OFF])->default(OFF);
            $table->foreign('books_id')->references('id')->on('books')->onDelete('cascade');
            $table->foreign('teachers_id')->references('id')->on('teachers')->onDelete('cascade');
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
        Schema::dropIfExists('teacherrents');
    }
}
