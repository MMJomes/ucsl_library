<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMemberTblTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('member_tbl', function (Blueprint $table) {
             $table->id();
             $table->string('batch_no');
             $table->string('year');
             $table->string('roll_no');
             $table->string('name');
             $table->string('username');
             $table->string('password');
             $table->dateTime('dob');
             $table->string('qualification');
             $table->string('occupation');
             $table->string('departement');
             $table->integer('office_phone');
             $table->string('office_address');
             $table->integer('home_phone');
             $table->string('resident');
             $table->integer('mobile');
             $table->string('email');
            $table->string('slug');
            $table->enum('status', [ON, OFF])->default(OFF);
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
        Schema::dropIfExists('member_tbl');
    }
}
