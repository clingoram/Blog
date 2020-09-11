<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMemberidAndAccountAndStatsuAndRoleAndregisternameToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('users')){
            Schema::table('users', function (Blueprint $table) {
                $table->string('memebr_id')->unique()->comment('會員ID');
                $table->char('account',50)->unique()->comment('帳號');
                $table->integer('status')->default(1)->comment('會員狀態，1=開啟，0=刪除，2=封鎖');
                $table->char('role',10)->comment('會員身分,R/M');
                $table->dateTime('registertime',0)->comment('註冊時間');
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
        // Schema::table('users', function (Blueprint $table) {
        //     //
        // });
        Schema::dropIfExists('users');
    }
}
