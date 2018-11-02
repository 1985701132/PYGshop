<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodsSkuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goods_sku', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('sku_name')->comment('SKU名'); 
            $table->integer('stock')->comment('库存量'); 
            $table->decimal('price', 10, 2)->comment('价格'); 
            $table->integer('goods_id')->comment('所属商品ID');
            $table->engine='innodb';
            $table->comment='商品SKU表'; 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('goods_sku');
    }
}
