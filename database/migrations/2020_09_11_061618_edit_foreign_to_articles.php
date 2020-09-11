<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EditForeignToArticles extends Migration
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
                $table->foreign('user_id')->references('memebr_id')->on('users');
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
        // Schema::table('articles', function (Blueprint $table) {
        //     //
        // });
        Schema::disableForeignKeyConstraints();
        Schema::table('articles', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });
        Schema::enableForeignKeyConstraints();
    }
}
