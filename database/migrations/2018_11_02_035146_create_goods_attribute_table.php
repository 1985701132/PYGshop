<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodsAttributeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goods_attribute', function (Blueprint $table) {
            $table->string('attr_name')->comment('属性名'); 
            $table->string('attr_value')->comment('属性值');  
            $table->integer('goods_id')->comment('所属商品ID');
            $table->engine='innodb';
            $table->comment='商品属性表'; 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('goods_attribute');
    }
}
