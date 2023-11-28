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
        Schema::table('users', function (Blueprint $table) {
            $table->tinyInteger('admin')->default(0)->after('public');
            $table->integer('new_post_num')->nullable()->after('admin');
            $table->string('new_post_city')->nullable()->after('new_post_num');
            $table->string('new_post_adress')->nullable()->after('new_post_city');
            $table->string('post_city')->nullable()->after('new_post_adress');
            $table->string('post_adress')->nullable()->after('post_city');
            $table->integer('post_num')->nullable()->after('post_adress');
            $table->integer('discount')->default(0)->after('post_num');
            $table->tinyInteger('selfship')->default(0)->after('discount');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('admin');
            $table->dropColumn('new_post_num');
            $table->dropColumn('new_post_city');
            $table->dropColumn('new_post_adress');
            $table->dropColumn('post_city');
            $table->dropColumn('post_adress');
            $table->dropColumn('post_num');
            $table->dropColumn('discount');
            $table->dropColumn('selfship');
        });
    }
};
