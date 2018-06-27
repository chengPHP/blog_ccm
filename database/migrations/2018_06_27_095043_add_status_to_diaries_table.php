<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStatusToDiariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('diaries', function (Blueprint $table) {
            $table->tinyInteger('status')->default(1)->comment('状态 -1|软删除 0|隐藏 1|显示');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('diaries', function (Blueprint $table) {
            //
        });
    }
}
