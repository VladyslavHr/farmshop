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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('product_id')->unsigned();
            $table->string('name');
            $table->string('last_name');
            $table->string('email');
            $table->string('phone');
            $table->double('price_per_one');
            $table->double('total');
            $table->integer('product_quantity');
            $table->string('new_post_num')->nullable();
            $table->string('new_post_adress')->nullable();
            $table->string('post_num')->nullable();
            $table->string('post_adress')->nullable();
            $table->tinyInteger('self_shipping')->default(0);
            $table->string('order_note')->nullable();
            $table->timestamps();
        });

        Schema::table('orders', function($table) {
            $table->foreign('product_id')->on('products')->references('id')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
