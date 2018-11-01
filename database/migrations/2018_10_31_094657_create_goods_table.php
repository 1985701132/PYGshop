<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goods', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('goods_name',10)->comment('商品名');
            $table->string('logo')->comment('logo');   
            $table->text('description')->comment('商品描述');
            $table->enum('is_on_sale',['yes','no '])->default('yes')->comment('是否上架');
            $table->integer('brand_id')->comment('品牌ID');
            $table->integer('cat1_id')->comment('一级分类ID');
            $table->integer('cat2_id')->comment('二级分类ID');
            $table->integer('cat3_id')->comment('三级分类ID');
            $table->engine='innodb';
            $table->comment='商品表';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('goods');
    }
}
