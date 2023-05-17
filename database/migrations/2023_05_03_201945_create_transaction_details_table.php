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
        Schema::create('transaction_details', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('transactions_id');
            $table->foreign('transactions_id')->references('id')->on('transactions');
            $table->uuid('products_id');
            $table->foreign('products_id')->references('id')->on('products');
            $table->string('product_name');
            $table->string('product_image');
            $table->integer('product_price')->unsigned()->default(0);
            $table->integer('product_capital_price')->unsigned()->default(0);
            $table->integer('qty')->unsigned();
            $table->integer('profit')->unsigned();
            $table->integer('sub_total')->unsigned();
            $table->integer('weight')->unsigned();
            $table->string('courier');
            $table->integer('shipping_costs')->unsigned();
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
        Schema::dropIfExists('transaction_details');
    }
};
