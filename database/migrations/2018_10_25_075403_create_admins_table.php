<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('username',10)->comment('用户名');
            $table->char('password',60)->comment('密码');
            $table->unsignedBigInteger('mobile')->comment('手机号码');
            $table->char('email',60)->comment('邮箱');
            $table->tinyInteger('is_use')->default(1)->comment('是否启用');
            $table->engine='innodb';
            $table->comment='管理员表';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admins');
    }
}
