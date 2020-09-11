<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToArticles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('articles', 'user_id')) {
            Schema::disableForeignKeyConstraints();
            Schema::table('articles', function (Blueprint $table) {
                $table->integer('user_id')->unsigned();

                $table->foreign('user_id')->references('memebr_id')->on('users')->onUpdate('cascade');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::table('articles', function (Blueprint $table) {
            $table->dropIfExists('articles');
        });
        Schema::enableForeignKeyConstraints();
    }
}