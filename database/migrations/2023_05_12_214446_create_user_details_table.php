<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_details', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('users_id');
            $table->foreign('users_id')->references('id')->on('users')->cascadeOnDelete();
            $table->string('address');
            $table->string('address_detail')->nullable();
            $table->integer('provinces_id')->unsigned();
            $table->integer('city_id')->unsigned();
            $table->integer('postal_code')->unsigned();
            $table->string('phone_number');
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
        Schema::dropIfExists('user_details');
    }
};
