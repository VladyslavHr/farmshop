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
        Schema::create('product_categories', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('product_type_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->string('slug');
            $table->string('name');
            $table->longText('description')->nullable();
            $table->string('main_img')->nullable();
            $table->string('logo')->nullable();
            $table->string('seo_title')->nullable();
            $table->string('seo_keywords')->nullable();
            $table->text('seo_description')->nullable();
            $table->tinyInteger('public')->default(1);
            $table->timestamps();
        });

        Schema::table('product_categories', function($table) {
            $table->foreign('product_type_id')->on('product_types')->references('id')->onDelete('cascade');
        });

        Schema::table('product_categories', function($table) {
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
        Schema::dropIfExists('product_categories');
    }
};
