<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('works', function (Blueprint $table) {
            $table->increments('id');
            $table->text("contents")->nullable()->comment('工作内容');
            $table->text('work_details')->nullable()->comment('工作详情计划');
            $table->string('plan_start_time')->nullable()->comment('工作计划开始时间');
            $table->string('plan_end_time')->nullable()->comment('工作计划完成时间');
            $table->string('start_time')->nullable()->comment('工作真实开始时间');
            $table->string('end_time')->nullable()->comment('工作真实完成时间');
            $table->integer('status')->default(0)->comment('工作当前状态 -1|已取消 0|新建 1|进行中 2|已完成 3|未完成');
            $table->text('work_result')->nullable()->comment('工作结果详情');
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
        Schema::dropIfExists('works');
    }
}
