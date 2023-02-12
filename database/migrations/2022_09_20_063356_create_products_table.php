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
            $table->id();
            $table->bigInteger('product_category_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->string('slug');
            $table->string('name');
            $table->double('price', 10, 2);
            $table->double('old_price', 10, 2)->default(0);
            $table->longText('description')->nullable();
            $table->string('main_img')->nullable();
            $table->string('price_type')->nullable();
            $table->string('status')->default('in_stock');
            $table->bigInteger('quantity')->default(0);
            $table->string('seo_title')->nullable();
            $table->string('seo_keywords')->nullable();
            $table->text('seo_description')->nullable();
            $table->tinyInteger('public')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('products', function($table) {
            $table->foreign('product_category_id')->on('product_categories')->references('id')->onDelete('cascade');
        });

        Schema::table('products', function($table) {
            $table->foreign('user_id')->on('users')->references('id')->onDelete('cascade');
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
