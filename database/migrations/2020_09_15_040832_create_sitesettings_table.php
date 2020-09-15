<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSitesettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('sitesettings')){
            Schema::create('sitesettings', function (Blueprint $table) {
                $table->unsignedInteger('id');
                $table->timestamps();
                $table->integer('memberid')->unsigned()->comment('會員ID');
                $table->foreign('memberid')->references('memberid')->on('users')->onDelete('cascade');
                $table->string('site_status')->default('on')->comment('網站開關，on、off');
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
        Schema::dropIfExists('sitesettings');
    }
}
