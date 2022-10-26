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
        Schema::create('product_types', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->string('name');
            $table->longText('description')->nullable();
            $table->string('slug');
            $table->string('logo')->nullable();
            $table->string('main_img')->nullable();
            $table->string('seo_title');
            $table->string('seo_keywords');
            $table->text('seo_description');
            $table->tinyInteger('public')->default(1);
            $table->timestamps();
        });

        Schema::table('product_types', function($table) {
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
        Schema::dropIfExists('product_types');
    }
};
