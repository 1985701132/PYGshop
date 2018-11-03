<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodsImageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goods_image', function (Blueprint $table) {
            $table->increments('id');
            $table->string('path')->comment('图片路径');   
            $table->integer('goods_id')->comment('所属商品ID');
            $table->engine='innodb';
            $table->comment='商品图片表';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('goods_image');
    }
}
