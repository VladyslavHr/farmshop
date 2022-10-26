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
            $table->longText('cart')->nullable()->after('phone');
            $table->string('post_number')->nullable()->after('cart');
            $table->string('street')->nullable()->after('post_number');
            $table->string('city')->nullable()->after('street');
            $table->string('region')->nullable()->after('city');
            $table->string('role')->nullable()->after('region');
            $table->string('sex')->nullable()->after('role');
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
            $table->dropColumn('cart');
            $table->dropColumn('post_number');
            $table->dropColumn('street');
            $table->dropColumn('city');
            $table->dropColumn('region');
            $table->dropColumn('role');
            $table->dropColumn('sex');
        });
    }
};
