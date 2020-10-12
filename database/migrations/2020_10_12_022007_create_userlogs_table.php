<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {   
        // A table which record user who is login,logout,update,delete or insert posts,etc. 
        Schema::create('userlogs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('member_id')->comment('會員ID');
            $table->foreign('member_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('note')->comment('會員action訊息');
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
        Schema::dropIfExists('userlogs');
    }
}
