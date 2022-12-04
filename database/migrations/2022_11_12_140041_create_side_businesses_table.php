<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSideBusinessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('side_businesses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('keyword');
            $table->string('description');
            $table->string('business_image');
            $table->string('social_link');
            $table->string('business_pdf')->nullable();
            $table->string('business_reg')->nullable();
            $table->string('business_address');
            $table->string('business_phone')->nullable();
            $table->string('created_by');
            $table->string('updated_by');
            $table->string('slug');
            $table->unsignedBigInteger('member_tbl_id');
            $table->unsignedBigInteger('biz_type_tbl_id');
            $table->timestamps();
            $table->foreign('biz_type_tbl_id')->references('id')->on('biz_type_tbl')->onDelete('cascade');
            $table->foreign('member_tbl_id')->references('id')->on('member_tbl')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('side_businesses');
    }
}
