<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStduentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stduents', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('std_classes_id');
            $table->string('image')->nullable();
            $table->string('name');
            $table->string('slug');
            $table->string('rollno')->unique();
            $table->string('email')->unique()->nullable();
            $table->string('phoneNo')->nullable();
            $table->string('Address')->nullable();
            $table->string('totalNoOfBooks')->default(0);
            $table->string('totalNoOfreturn')->default(0);
            $table->enum('status', [ON, OFF])->default(OFF);
            $table->timestamps();
            $table->foreign('std_classes_id')->references('id')->on('std_classes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stduents');
    }
}
