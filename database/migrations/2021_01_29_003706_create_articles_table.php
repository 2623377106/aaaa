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
        Schema::create('articles', function (Blueprint $table) {
            $table->id('id')->comment('文章id');
            $table->string('title',200)->comment('文章标题');
            $table->string('name',50)->comment('文章作者');
            $table->string('file',200)->comment('文章封面');
            $table->string('desn',200)->comment('文章摘要');
            $table->text('body')->comment('文章内容');
            $table->softDeletes();
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
        Schema::dropIfExists('articles');
    }
}
