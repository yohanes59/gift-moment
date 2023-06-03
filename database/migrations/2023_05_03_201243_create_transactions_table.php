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
        Schema::create('transactions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('users_id');
            $table->foreign('users_id')->references('id')->on('users');
            $table->integer('total')->unsigned();
            $table->string('courier');
            $table->integer('shipping_costs')->unsigned();
            $table->enum('payment_status', ['PAID', 'UNPAID']);
            $table->enum('order_status', ['NEW_ORDER', 'PACKED', 'SHIPPED', 'COMPLETED'])->nullable();
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
        Schema::dropIfExists('transactions');
    }
};
