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
        Schema::create('products', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('categories_id')->nullable();
            $table->foreign('categories_id')->references('id')->on('categories')->cascadeOnDelete();
            $table->string('name');
            $table->string('image');
            $table->integer('price')->unsigned()->default(0);
            $table->integer('capital_price')->unsigned()->default(0);
            $table->text('description');
            $table->integer('weight')->unsigned();
            $table->integer('stock_amount')->unsigned()->default(0);
            $table->string('slug');
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
        Schema::dropIfExists('products');
    }
};
