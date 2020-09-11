<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('articles')){

            Schema::create('articles', function (Blueprint $table) {
                $table->id('id');
                $table->char('title',200)->connemt('標題');
                $table->integer('status')->default(1)->comment('文章狀態，隱藏2、刪除0、開啟1');
                $table->string('content')->comment('內容');
                $table->timestamps();
                $table->dateTime('build_time',0)->comment('文章建立時間');
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
        Schema::dropIfExists('articles');
    }
}
