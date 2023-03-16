<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('departements_id');
            $table->string('image')->default('/default-user.png');;
            $table->string('name');
            $table->string('slug');
            $table->string('email')->unique()->nullable();
            $table->string('phoneNo')->nullable();
            $table->string('Address')->nullable();
            $table->string('totalNoOfBooks')->default(0);
            $table->string('totalNoOfreturn')->default(0);
            $table->enum('status', [ON, OFF])->default(OFF);
            $table->timestamps();
            $table->foreign('departements_id')->references('id')->on('departements')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('teachers');
    }
}
