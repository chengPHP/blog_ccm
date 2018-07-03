<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeedbacksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feedbacks', function (Blueprint $table) {
            $table->increments('id');
            $table->text('content')->nullable()->comment('留言内容');
            $table->integer('pid')->nullable()->comment('父级id');
            $table->string('path')->nullable()->comment('留言路径');
            $table->integer('user_id')->nullable()->comment('所属用户');
            $table->tinyInteger('status')->default(1)->comment('状态 -1|软删除 0|禁用 1|启用');
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
        Schema::dropIfExists('feedbacks');
    }
}
