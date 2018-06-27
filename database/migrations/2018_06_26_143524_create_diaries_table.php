<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //个人日记
        Schema::create('diaries', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("user_id")->nullable()->comment("作者");
            $table->text('art')->nullable()->comment("日记内容");
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
        Schema::dropIfExists('diaries');
    }
}
